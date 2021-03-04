<?php

namespace App\Http\Controllers\Api;

use Anand\LaravelPaytmWallet\Facades\PaytmWallet;
use App\Classes\VideoStream;
use App\Models\Article;
use App\Models\ArticleRate;
use App\Models\Balance;
use App\Models\Blog;
use App\Models\Channel;
use App\Models\Content;
use App\Models\ContentCategory;
use App\Models\ContentComment;
use App\Models\ContentPart;
use App\Models\ContentRate;
use App\Models\ContentSupport;
use App\Models\Discount;
use App\Models\Event;
use App\Models\Follower;
use App\Models\Login;
use App\Models\Record;
use App\Models\Requests;
use App\Models\Sell;
use App\Models\SellRate;
use App\Models\Tickets;
use App\Models\TicketsMsg;
use App\Models\Transaction;
use App\Models\TransactionCharge;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ContentVip;
use Illuminate\Support\Facades\Storage;
use kcfinder\fastImage;
use PayPal\Api\Amount;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Unicodeveloper\Paystack\Facades\Paystack;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\CalendarEvents;
use App\Models\Quiz;
use App\Models\QuizResult;
use App\Models\Usercategories;
use App\Models\ProgresoAlumno;
use Carbon\Carbon;
use App\Models\QuizzesQuestion;
use App\Models\QuizzesQuestionsAnswer;
use App\Models\RegistroDescargas;
use App\Models\Chat_Chats;
use App\Models\Chat_Messages;
use App\Models\Chat_UsersInChat;
use App\Models\Homeworks;
use App\Models\HomeworksUser;
use App\Models\Course_guides;

class ApiController extends Controller
{

    public function __construct()
    {
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
                $paypal_conf['client_id'],
                $paypal_conf['secret'])
        );
        $this->_api_context->setConfig($paypal_conf['settings']);
    }
    ## Private Function
    private function response($data, $status = '1'){
        return ['status'=>$status,'data'=>$data];
    }
    private function error($code = -1, $description){
        return ['status'=>-1,'code'=>$code,'error'=>$description];
    }
    private function userInfo($id){
        $user   = User::with('usermetas')->find($id);
        $metas  = arrayToList($user->usermetas,'option','value');
        $month  = strtotime(date('Y-m-01 00:00:00'));
        $day    = strtotime(date('Y-m-d 00:00:00'));
        if($user->token == null || $user->token == ''){
            $user->update(['token'=>Str::random(24)]);
            $user->refresh();
        }

        $couses         = Sell::where('buyer_id', $user->id)->where('mode','pay')->count();
        $contents       = Content::where('user_id', $user->id)->pluck('id')->toArray();

        $sell['today']  = Transaction::whereIn('content_id', $contents)->where('mode','deliver')->where('created_at','>',$day)->count();
        $sell['month']  = Transaction::whereIn('content_id', $contents)->where('mode','deliver')->where('created_at','>',$month)->count();
        $sell['total']  = Transaction::whereIn('content_id', $contents)->where('mode','deliver')->count();

        return [
            'id'        => $user->id,
            'username'  => $user->username,
            'name'      => $user->name,
            'email'     => $user->email,
            'phone'     => isset($metas['phone'])?$metas['phone']:'',
            'city'      => isset($metas['city'])?$metas['city']:'',
            'age'       => isset($metas['old'])?$metas['old']:'',
            'income'    => $user->income,
            'credit'    => $user->credit,
            'mode'      => $user->mode,
            'last_view' => is_numeric($user->last_view)?date('Y-m-d H:i', $user->last_view):'',
            'view'      => $user->view,
            'rate_point'=> $user->rate_point,
            'rate_count'=> $user->rate_count,
            'vendor'    => $user->vendor,
            'token'     => $user->token,
            'currency'  => currencySign(),
            'courses'   => $couses,
            'sell'      => $sell,
            'new_sales' => 0,
            'new_messages'  => 0,
            'comments'  => 0
        ];
    }
    private function checkUserToken(Request $request){
        $user = User::where('token', $request->token)->first();
        if(!$user)
            return false;

        return $this->userInfo($user->id);
    }
    private function stream($id){
        $part = ContentPart::with('content')->where('mode','publish')->find($id);
        $storagePath  = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
        $file = $storagePath.'source/content-'.$part->content->id.'/video/part-'.$part->id.'.mp4';

        if(!file_exists($file))
            return 'no file exit';

        $stream = new VideoStream($file);
        $stream->start();
    }
    private function checkDiscount($code, $price = null){
        $Mode = false;

        if($price = null || $price == 0)
            return ['status'=>$Mode,'price'=>0];

        $Discount = Discount::where('code', $code)
            ->where('expire_at','>', time())
            ->where('mode','publish')
            ->first();

        if($Discount){
            $Mode = true;
            if($Discount->type == 'off'){
                $price = round($price * ((100 - $Discount->off)/100),2);
            }
            if($Discount->type == 'gift'){
                $price = round($price - $Discount->off,2);
            }
        }


        return ['status'=>$Mode,'price'=>$price];
    }
    private function productPrice($Product = null){
        if($Product == null)
            return 0;
        if(!isset($Product->metas))
            return 0;

        foreach ($Product->metas as $meta){
            if($meta['option'] == 'price'){
                $Price = pricePay($Product->id,$Product->category_id,$meta['value']);
                return intval($Price);
            }
        }

        return 0;
    }


    public function functionList(){
        echo '<ul>';
        echo '<li><a href="#">Content</a></li>';
        echo '<li><a href="#">index</a></li>';
        echo '</ul>';
    }

    ## Index Page ##
    public function functionIndex(){
        $result = [];
        $data   = [];
        ## Gateway
        $data['gateway'][] = 'income';
        if(get_option('gateway_paypal') == 1) $data['gateway'][] = 'paypal';
        if(get_option('gateway_paystack',0) == 1) $data['gateway'][] = 'paystack';
        if(get_option('gateway_paytm',0) == 1) $data['gateway'][] = 'paytm';
        if(get_option('gateway_payu',0) == 1) $data['gateway'][] = 'payu';
        ## Get Blog Posts
        $result['blogPosts']        = Blog::where('mode','publish')->limit(5)->orderBy('id','DESC')->get();## Get Blog Posts
        $result['articlePosts']     = Article::where('mode','publish')->limit(5)->orderBy('id','DESC')->get();
        $result['sell_content']     = Content::with('metas','user')->withCount('sells')->where('mode','publish')->limit(15)->orderBy('sells_count','DESC')->get();
        $result['new_content']      = Content::with('metas')->where('mode','publish')->limit(15)->orderBy('id','DESC')->get();
        $result['popular_content']  = Content::with('metas')->where('mode','publish')->limit(15)->orderBy('view','DESC')->get();
        $result['vip_content']      = ContentVip::with('content')->where('mode','publish')->where('first_date','<',time())->where('last_date','>',time())->limit(15)->get();
        $result['slider_container'] = ContentVip::with(['content'=>function($q){
            $q->with(['metas','user']);
        }])
            ->where('first_date','<',time())
            ->where('last_date','>',time())
            ->where('mode','publish')
            ->where('type','slide')
            ->get();

        $result['requests']         = Requests::with(['content','category'])->withCount(['fans'])->where('mode','<>','draft')->orderBy('id','DESC')->take(20)->get();

        $result['category']         = ContentCategory::withCount(['contents','childs'])->with(['childs'=>function($c){
            $c->withCount(['contents']);
        }])->where('parent_id','0')->get();

        $result['records']          = Record::with(['content','category','fans'])->withCount(['fans'])->where('mode','publish')->take(10)->get();

        foreach ($result['new_content'] as $newContent){
            $meta = arrayToList($newContent->metas,'option','value');
            $data['content']['new'][] = [
                'id'        => $newContent->id,
                'title'     => $newContent->title,
                //'thumbnail' => $meta['thumbnail'] ? $meta['thumbnail'] : '',
                'thumbnail' => '',
                'price'     => isset($meta['price'])?$meta['price']:0,
                'currency'  => currencySign(),
                'duration'  => isset($meta['duration'])?convertToHoursMins($meta['duration']):0
            ];
        }
        foreach ($result['popular_content'] as $popularContent){
            $meta = arrayToList($popularContent->metas,'option','value');
            $data['content']['popular'][] = [
                'id'        => $popularContent->id,
                'title'     => $popularContent->title,
                'thumbnail' => $meta['thumbnail'],
                'price'     => isset($meta['price'])?$meta['price']:0,
                'currency'  => currencySign(),
                'duration'  => isset($meta['duration'])?convertToHoursMins($meta['duration']):0
            ];
        }
        foreach ($result['vip_content'] as $vipContent){
            $vipContent = $vipContent->content;
            $meta = arrayToList($vipContent->metas,'option','value');
            $data['content']['vip'][] = [
                'id'        => $vipContent->id,
                'title'     => $vipContent->title,
                'thumbnail' => $meta['thumbnail'],
                'price'     => isset($meta['price'])?$meta['price']:0,
                'currency'  => currencySign(),
                'duration'  => isset($meta['duration'])?convertToHoursMins($meta['duration']):0
            ];
        }
        foreach ($result['sell_content'] as $sellContent){
            $meta = arrayToList($sellContent->metas,'option','value');
            $data['content']['sell'][] = [
                'id'        => $sellContent->id,
                'title'     => $sellContent->title,
                'thumbnail' => $meta['thumbnail'],
                'price'     => isset($meta['price'])?$meta['price']:0,
                'currency'  => currencySign(),
                'duration'  => isset($meta['duration'])?convertToHoursMins($meta['duration']):0
            ];
        }
        foreach ($result['slider_container'] as $sliderContent){
            $sliderContent = $sliderContent->content;
            $meta = arrayToList($sliderContent->metas,'option','value');
            $data['content']['slider'][]    = checkUrl($meta['thumbnail']);
            $data['content']['slider_id'][] = $sliderContent->id;
        }
        foreach ($result['blogPosts'] as $post){
            $data['content']['news'][] = [
                'title'     => $post->title,
                'date'      => date('Y F d', $post->created_at),
                'url'       => url('/').'/blog/mobile/'.$post->id,
                'image'     => strpos($post->image,'http') !== false?$post->image:url('/').$post->image
            ];
        }
        foreach ($result['articlePosts'] as $article){
            $data['content']['article'][] = [
                'title'     => $article->title,
                'date'      => date('Y F d', $article->created_at),
                'url'       => url('/').'/blog/mobile/'.$article->id.'?type=article',
                'image'     => strpos($article->image,'http') !== false?$article->image:url('/').$article->image
            ];
        }
        foreach ($result['category'] as $cat){
            $count = 0;
            foreach ($cat->childs as $child){
                $count+= getCategoryCount($child->id);
            }
            $data['content']['category'][] = [
                'id'            => $cat->id,
                'icon'          => $cat->app_icon,
                'count'         => $count,
                'title'         => $cat->title,
                'childs'        => $cat->childs,
                'childsCount'   => $cat->childs_count
            ];
        }
        foreach ($result['requests'] as $req){
            if(isset($req->category->app_icon)) {
                $data['requests'][] = [
                    'id'            => $req->id,
                    'title'         => $req->title,
                    'description'   => $req->description,
                    'fans'          => $req->fans_count,
                    'image'         => isset($req->category->app_icon) ? checkUrl($req->category->app_icon) : ''
                ];
            }
        }
        foreach ($result['records'] as $record){
            $data['records'][] = [
                'id'            => $record->id,
                'title'         => $record->title,
                'description'   => $record->description,
                'image'         => checkUrl($record->image),
                'fans'          => $record->fans_count
            ];
        }

        $data = stripTagsAll($data);
        return $this->response($data);
    }
    ## Content Section ##
    public function contents($last = 0){
        return Content::with('metas')
            ->where('mode','publish')
            ->where('id','>',$last)
            ->orderBy('id','DESC')
            ->take(20)
            ->get();
    }
    ## Product ##
    public function product($id,Request $request){
        $data = [];
        $User   = $this->checkUserToken($request);
        $content = Content::with(['metas','category','parts','rates','user.usermetas','comments.user'])->with(['quizzes' => function ($q) {
            $q->where('status', 'active');
        }])->find($id);
        
        $hasCertificate = false;
        $canDownloadCertificate = false;

        if ($User) {
            $quizzes = $content->quizzes;
            foreach ($quizzes as $quiz) {
                $canTryAgainQuiz = false;
                $userQuizDone = QuizResult::where('quiz_id', $quiz->id)
                    ->where('student_id', $User['id'])
                    ->orderBy('id', 'desc')
                    ->get();

                if (count($userQuizDone)) {
                    $quiz->user_grade = $userQuizDone->first()->user_grade;
                    $quiz->result_status = $userQuizDone->first()->status;
                    $quiz->result = $userQuizDone->first();
                    $quiz->student_id = $userQuizDone->first()->student_id;
                    if ($quiz->result_status == 'pass') {
                        $canDownloadCertificate = true;
                    }
                }

                if (!isset($quiz->attempt) or (count($userQuizDone) < $quiz->attempt and $quiz->result_status !== 'pass')) {
                    $canTryAgainQuiz = true;
                }
                $quiz->user_attempts = count($userQuizDone);
                $quiz->times_can_try = $quiz->attempt - count($userQuizDone);
                $quiz->can_try = $canTryAgainQuiz;

                if ($quiz->certificate) {
                    $hasCertificate = true;
                }
            }
        }

        $meta    = arrayToList($content->metas, 'option','value');

        $MB = 0;
        foreach($content->parts as $part)
            $MB = $MB + $part['size'];

        ## Get PreCourse Content ##
        if(isset($meta['precourse']))
            $preCourseIDs = explode(',',rtrim($meta['precourse'],','));
        else
            $preCourseIDs = [];
        $preCousreContent = Content::with(['metas'])->where('mode','publish')->whereIn('id',$preCourseIDs)->get();
        $preRequisites    = [];
        foreach ($preCousreContent as $pcc){
            $meta = arrayToList($pcc->metas, 'option','value');
            $preRequisites[] = [
                'id'        => $pcc->id,
                'title'     => $pcc->title,
                'thumbnail' => $meta['thumbnail'],
                'price'     => isset($meta['price'])?$meta['price']:0,
                'currency'  => currencySign(),
                'duration'  => isset($meta['duration'])?convertToHoursMins($meta['duration']):0
            ];
        }

        ## Get Related Content ##
        $related        = [];
        $relatedCat     = $content->category_id;
        $relatedContent = Content::with(['metas'])->where('category_id',$relatedCat)->where('id','<>',$content->id)->where('mode','publish')->limit(3)->inRandomOrder()->get();
        foreach ($relatedContent as $rc){
            $meta = arrayToList($rc->metas, 'option','value');
            $related[] = [
                'id'        => $rc->id,
                'title'     => $rc->title,
                'thumbnail' => $meta['thumbnail'] ? $meta['thumbnail'] : '',
                'price'     => isset($meta['price'])?$meta['price']:0,
                'currency'  => currencySign(),
                'duration'  => isset($meta['duration'])?convertToHoursMins($meta['duration']):0
            ];
        }

        ## Comments
        $comments = [];
        foreach ($content->comments as $comment){
            if($comment->mode == 'publish') {
                $comments[] = [
                    'id' => $comment->id,
                    'user' => isset($comment->user->name) ? $comment->user->name : '',
                    'comment' => $comment->comment
                ];
            }
        }

        ## Support
        /*$support  = [];
        if(isset($User)){
            $supports = ContentSupport::where(function($w) use ($User){
                $w->where('user_id', $User['id'])->orWhere('sender_id', $User['id']);
            })->where('content_id',$id)->where('mode','publish')->get();
            foreach ($supports as $s){
                if($s->sender_id == $s->user_id){
                    $type = 'user';
                }else{
                    $type = 'supporter';
                }
                $support[] = [
                    'name'      => $s->name,
                    'comment'   => $s->comment,
                    'type'      => $type,
                    'date'      => date('Y F,d H:i', $s->created_at)
                ];
            }
        }*/

        ## User
        $user['avatar'] = '';
        $user['id']     = $content->user_id;
        $user['name']   = isset($content->user->name)?$content->user->name:'';
        foreach ($content->user->usermetas as $um){
            if($um->option == 'avatar'){
                $user['avatar'] = checkUrl($um->value);
            }
        }

        ## Parts
        $parts = [];

        foreach ($content->parts as $part){

            $progreso_alumno = ProgresoAlumno::where('user_id', $User['id'])->where('content_id', $id)->where('part_id', $part->id)->get();

            $partStatus = '';

            if($progreso_alumno->isEmpty()){

                $primeraParte = ContentPart::where('content_id', $id)->orderBy('id', 'asc')->first();

                if($part->id == $primeraParte->id){
                    $partStatus = 'actual';
                }else{
                    $partStatus = 'pending';
                }
            }else{

                $progreso_alumno = ProgresoAlumno::where('user_id', $User['id'])->where('content_id', $id)->orderBy('part_id', 'desc')->first();

                if($part->id == $progreso_alumno->part_id){
                    $partStatus = 'actual';
                }else{
                    $partStatus = 'finished';
                }
            }

            if($part->limit_date){
                if(Carbon::now()->format('Y-m-d') > $part->limit_date && $partStatus == 'pending'){
                    $partStatus = 'late';
                }
            }elseif($part->initial_date){
                if(Carbon::now()->format('Y-m-d') < $part->initial_date && $partStatus == 'pending'){
                    $partStatus = 'early';
                }
            }

            $quizzes = $content->quizzes->where('part_id', $part->id);
            foreach ($quizzes as $quiz) {
                $canTryAgainQuiz = false;
                $userQuizDone = QuizResult::where('quiz_id', $quiz->id)
                    ->where('student_id', $User['id'])
                    ->orderBy('id', 'desc')
                    ->get();

                if (count($userQuizDone)) {
                    $quiz->user_grade = $userQuizDone->first()->user_grade;
                    $quiz->result_status = $userQuizDone->first()->status;
                    $quiz->result = $userQuizDone->first();
                    $quiz->student_id = $userQuizDone->first()->student_id;
                    if ($quiz->result_status == 'pass') {
                        $canDownloadCertificate = true;
                    }
                }

                if (!isset($quiz->attempt) or (count($userQuizDone) < $quiz->attempt and $quiz->result_status !== 'pass')) {
                    $canTryAgainQuiz = true;
                }
                $quiz->user_attempts = count($userQuizDone);
                $quiz->times_can_try = $quiz->attempt - count($userQuizDone);
                $quiz->can_try = $canTryAgainQuiz;

                if ($quiz->certificate) {
                    $hasCertificate = true;
                }
            }

            $parts[] = [
                'id'        => $part->id,
                'title'     => $part->title,
                'video' => $part->upload_video,
                'video_duration' => $part->duration,
                'description' => $part->description, 
                'initial_date' => $part->initial_date,
                'limit_date' => $part->limit_date,
                'part_material' => url('/').'/bin/contenido-cursos/'.$id.'/'.$part->id.'/materiales.zip',
                'status' => $partStatus,
                'quizzes' => $quizzes->isEmpty() ? null : $quizzes->values()
                
            ];
        }

        ## Check User Purchase
        $buy = 0;
        if($User && isset($User['id'])){
            $Purchase = Sell::where('buyer_id', $User['id'])->where('mode','pay')->where('content_id', $id)->count();
            if($Purchase > 0){
                $buy = 1;
            }
            if($content->user_id == $User['id']){
                $buy = 1;
            }
        }

        $descargado = RegistroDescargas::where('user_id', $User['id'])->where('content_id', $id)->get();

        $data    = [
            'id'            => $content->id,
            'downloaded'    => $descargado->isEmpty() ? false : true,
            'content'       => $content->content,
            'title'         => $content->title,
            'material'      => url('/').'/bin/contenido-cursos/'.$id.'/materiales.zip',
            'guia' => url('/').'/bin/contenido-cursos/'.$id.'/guia/guia-'.$content->title.'.pdf',
            'category'      => isset($content->category) ? ['id'=>$content->category->id,'title'=>$content->category->title] : null,
            'cover'         => isset($meta['cover'])?checkUrl($meta['cover']):'',
            'thumbnail'     => isset($meta['thumbnail'])?checkUrl($meta['thumbnail']):'',
            'date'          => date('Y-m-d', $content->created_at),
            'parts'         => $parts,
            //'quizzes'       => $content->quizzes
        ];

        return $this->response(['product'=>$data]);
    }

    public function guia_curso($id, Request $request){

        $guides = Course_guides::where('content_id', $id)->get();

        //$content = Content::find($id);

        //return $this->response(['guia' => url('/').'/bin/contenido-cursos/'.$id.'/guia/guia-'.$content->title.'.pdf']);
        return $this->response($guides);

    }

    public function productPay(Request $request){
        $User = $this->checkUserToken($request);
        if(!$User)
            return redirect('/')->with('msg',trans('main.user_not_found'));
        $user = $User;

        if($request->gateway == 'paypal'){
            $content = Content::with('metas')->where('mode','publish')->find($request->id);
            if(!$content)
                abort(404);

            if($content->private == 1)
                $site_income = get_option('site_income_private');
            else
                $site_income = get_option('site_income');

            $meta = arrayToList($content->metas,'option','value');

            if($request->mode == 'download')
                $Amount = $meta['price'];
            elseif ($request->mode == 'post')
                $Amount = $meta['post_price'];

            $Description = trans('admin.item_purchased').$content->title.trans('admin.by').$User['name']; // Required
            $Amount_pay = pricePay($content->id,$content->category_id,$Amount)['price'];


            $payer = new Payer();
            $payer->setPaymentMethod('paypal');
            $item_1 = new Item();
            $item_1->setName($content->title)
                ->setCurrency('USD')
                ->setQuantity(1)
                ->setPrice($Amount);
            $item_list = new ItemList();
            $item_list->setItems(array($item_1));
            $amount = new Amount();
            $amount->setCurrency('USD')
                ->setTotal($Amount);
            $transaction = new \PayPal\Api\Transaction();
            $transaction->setAmount($amount)
                ->setItemList($item_list)
                ->setDescription('Purchase Product');
            $redirect_urls = new RedirectUrls();
            $redirect_urls->setReturnUrl(url('/').'/bank/paypal/status')
                ->setCancelUrl(url('/').'/bank/paypal/cancel/'.$request->id);
            $payment = new Payment();
            $payment->setIntent('Sale')
                ->setPayer($payer)
                ->setRedirectUrls($redirect_urls)
                ->setTransactions(array($transaction));
            try {
                $payment->create($this->_api_context);
            } catch (\PayPal\Exception\PPConnectionException $ex) {
                if (\Config::get('app.debug')) {
                    \Session::put('error', 'Connection timeout');
                    return Redirect::route('paywithpaypal');
                } else {
                    \Session::put('error', 'Some error occur, sorry for inconvenient');
                    return Redirect::route('paywithpaypal');
                }
            }
            foreach ($payment->getLinks() as $link) {
                if ($link->getRel() == 'approval_url') {
                    $redirect_url = $link->getHref();
                    break;
                }
            }
            $ids = $payment->getId();
            \Session::put('paypal_payment_id', $ids);
            Transaction::insert([
                'buyer_id'      => $User['id'],
                'user_id'       => $content->user_id,
                'content_id'    => $content->id,
                'price'         => $Amount_pay,
                'price_content' => $Amount,
                'mode'          => 'pending',
                'created_at'     => time(),
                'bank'          => 'paypal',
                'income'        => $Amount_pay - (($site_income/100)*$Amount_pay),
                'authority'     => $ids,
                'type'          => $request->mode
            ]);
            /** add payment ID to session **/
            if (isset($redirect_url)) {
                /** redirect to paypal **/
                return Redirect::away($redirect_url);
            }
            \Session::put('error', 'Unknown error occurred');
            return Redirect::route('paywithpaypal');
        }
        if($request->gateway == 'paytm'){
            $content = Content::with('metas')->where('mode','publish')->find($request->id);
            if(!$content)
                abort(404);

            if($content->private == 1)
                $site_income = get_option('site_income_private');
            else
                $site_income = get_option('site_income');

            $meta = arrayToList($content->metas,'option','value');

            if($request->mode == 'download')
                $Amount = $meta['price'];
            elseif ($request->mode == 'post')
                $Amount = $meta['post_price'];

            $Description = trans('admin.item_purchased').$content->title.trans('admin.by').$user['name']; // Required
            $Amount_pay = pricePay($content->id,$content->category_id,$Amount)['price'];

            $Transaction = Transaction::create([
                'buyer_id'      => $user['id'],
                'user_id'       => $content->user_id,
                'content_id'    => $content->id,
                'price'         => $Amount_pay,
                'price_content' => $Amount,
                'mode'          => 'pending',
                'created_at'     => time(),
                'bank'          => 'paytm',
                'authority'     => 0,
                'income'        => $Amount_pay - (($site_income/100)*$Amount_pay),
                'type'          => $request->mode
            ]);

            $payment = PaytmWallet::with('receive');
            $payment->prepare([
                'order'         => $Transaction->id,
                'user'          => $user['id'],
                'email'         => $user['email'],
                'mobile_number' => '00187654321',
                'amount'        => $Transaction->price,
                'callback_url'  => url('/').'/bank/paytm/status/'.$content->id
            ]);
            return $payment->receive();
        }
        if($request->gateway == 'payu'){
            $content = Content::with('metas')->where('mode','publish')->find($request->id);
            if(!$content)
                abort(404);

            if($content->private == 1)
                $site_income = get_option('site_income_private');
            else
                $site_income = get_option('site_income');

            $meta = arrayToList($content->metas,'option','value');

            if($request->mode == 'download')
                $Amount = $meta['price'];
            elseif ($request->mode == 'post')
                $Amount = $meta['post_price'];

            $Description = trans('admin.item_purchased').$content->title.trans('admin.by').$user['name']; // Required
            $Amount_pay = pricePay($content->id,$content->category_id,$Amount)['price'];
            $Transaction = Transaction::create([
                'buyer_id'      => $user['id'],
                'user_id'       => $content->user_id,
                'content_id'    => $content->id,
                'price'         => $Amount_pay,
                'price_content' => $Amount,
                'mode'          => 'pending',
                'created_at'     => time(),
                'bank'          => 'paytm',
                'authority'     => 0,
                'income'        => $Amount_pay - (($site_income/100)*$Amount_pay),
                'type'          => $request->mode
            ]);
        }
        if($request->gateway == 'paystack'){
            $content = Content::with('metas')->where('mode','publish')->find($request->id);
            if(!$content)
                abort(404);

            if($content->private == 1)
                $site_income = get_option('site_income_private');
            else
                $site_income = get_option('site_income');

            $meta = arrayToList($content->metas,'option','value');

            if($request->mode == 'download')
                $Amount = $meta['price'];
            elseif ($request->mode == 'post')
                $Amount = $meta['post_price'];

            $Description = trans('admin.item_purchased').$content->title.trans('admin.by').$user['name']; // Required
            $Amount_pay = pricePay($content->id,$content->category_id,$Amount)['price'];

            $Transaction = Transaction::create([
                'buyer_id'      => $user['id'],
                'user_id'       => $content->user_id,
                'content_id'    => $content->id,
                'price'         => $Amount_pay,
                'price_content' => $Amount,
                'mode'          => 'pending',
                'created_at'     => time(),
                'bank'          => 'paystack',
                'authority'     => 0,
                'income'        => $Amount_pay - (($site_income / 100) * $Amount_pay),
                'type'          => $request->mode
            ]);
            $payStack    = new \Unicodeveloper\Paystack\Paystack();
            $payStack->getAuthorizationResponse([
                "amount"        => $Amount_pay,
                "reference"     => Paystack::genTranxRef(),
                "email"         => $user['email'],
                "callback_url"  => url('/').'/api/v1/product/verify?gateway=paystack&content_id='.$content->id,
                'metadata'      => json_encode(['transaction'=>$Transaction->id])
            ]);
            return redirect($payStack->url);
        }
        if($request->gateway == 'credit'){
            $content = Content::with('metas')->where('mode','publish')->find($request->id);
            if(!$content)
                abort(404);

            $seller = User::with('category')->find($content->user_id);

            if($content->private == 1)
                $site_income = get_option('site_income_private');
            else
                $site_income = get_option('site_income');

            $meta = arrayToList($content->metas,'option','value');
            if($request->mode == 'download')
                $Amount = $meta['price'];
            elseif ($request->mode == 'post')
                $Amount = $meta['post_price'];

            $Amount_pay = pricePay($content->id,$content->category_id,$Amount)['price'];
            if($user['credit']-$Amount_pay<0) {
                return redirect('/api/v1/product/verify?gateway=credit&mode=failed&type=nocredit');
            }else{
                $transaction = Transaction::create([
                    'buyer_id'      =>$user['id'],
                    'user_id'       =>$content->user_id,
                    'content_id'    =>$content->id,
                    'price'         =>$Amount_pay,
                    'price_content' =>$Amount,
                    'mode'          =>'deliver',
                    'created_at'     =>time(),
                    'bank'          =>'credit',
                    'authority'     =>'000',
                    'income'        =>$Amount_pay - (($site_income/100)*$Amount_pay),
                    'type'          =>$request->mode
                ]);
                Sell::insert([
                    'user_id'       => $content->user_id,
                    'buyer_id'      => $user['id'],
                    'content_id'    => $content->id,
                    'type'          => $request->mode,
                    'created_at'     => time(),
                    'mode'          => 'pay',
                    'transaction_id'=> $transaction->id
                ]);

                $seller->update(['income'=>$seller->income+((100-$site_income)/100)*$Amount_pay]);
                $buyer = User::find($user['id']);
                $buyer->update(['credit'=>$user['credit']-$Amount_pay]);

                Balance::create([
                    'title'=>trans('admin.item_purchased').$content->title,
                    'description'=>trans('admin.item_purchased_desc'),
                    'type'=>'minus',
                    'price'=>$Amount_pay,
                    'mode'=>'auto',
                    'user_id'=>$buyer->id,
                    'exporter_id'=>0,
                    'created_at'=>time()
                ]);
                Balance::create([
                    'title'=>trans('admin.item_sold').$content->title,
                    'description'=>trans('admin.item_sold_desc'),
                    'type'=>'add',
                    'price'=>((100-$site_income)/100)*$Amount_pay,
                    'mode'=>'auto',
                    'user_id'=>$seller->id,
                    'exporter_id'=>0,
                    'created_at'=>time()
                ]);
                Balance::create([
                    'title'=>trans('admin.item_profit').$content->title,
                    'description'=>trans('admin.item_profit_desc').$buyer->username,
                    'type'=>'add',
                    'price'=>($site_income/100)*$Amount_pay,
                    'mode'=>'auto',
                    'user_id'=>0,
                    'exporter_id'=>0,
                    'created_at'=>time()
                ]);

                ## Notification Center
                $product = Content::find($transaction->content_id);
                sendNotification(0,['[c.title]'=>$product->title],get_option('notification_template_buy_new'),'user',$buyer->id);
                return redirect('/api/v1/product/verify?gateway=credit&mode=successfully')->with('msg',trans('admin.item_purchased_success'));
            }
            return redirect('/api/v1/product/verify?gateway=credit&mode=failed');
        }
    }
    public function productVerify(Request $request){

        if(isset($request->mode) && $request->mode == 'failed'){
            return view(getTemplate() . '.app.verify');
        }
        if(isset($request->mode) && $request->mode == 'successfully'){
            return view(getTemplate() . '.app.verify');
        }

        if($request->gateway == 'paypal'){
            $payment_id = \Session::get('paypal_payment_id');
            \Session::forget('paypal_payment_id');
            if (empty($request->PayerID) || empty($request->token)) {
                \Session::put('error', 'Payment failed');
                return Redirect::route('/');
            }
            $payment = Payment::get($payment_id, $this->_api_context);
            $execution = new PaymentExecution();
            $execution->setPayerId($request->PayerID);
            $result = $payment->execute($execution, $this->_api_context);
            $transaction = Transaction::where('mode','pending')->where('authority',$payment_id)->first();
            if ($result->getState() == 'approved') {
                $product = Content::find($transaction->content_id);
                $userUpdate = User::with('category')->find($transaction->user_id);
                if($product->private == 1)
                    $site_income = get_option('site_income_private')-$userUpdate->category->off;
                else
                    $site_income = get_option('site_income')-$userUpdate->category->off;

                if(empty($transaction))
                    \redirect('/product/'.$transaction->content_id);

                $Amount = $transaction->price;

                Sell::insert([
                    'user_id'       => $transaction->user_id,
                    'buyer_id'      => $transaction->buyer_id,
                    'content_id'    => $transaction->content_id,
                    'type'          => $transaction->type,
                    'created_at'     => time(),
                    'mode'          => 'pay',
                    'transaction_id'=> $transaction->id,
                    'remain_time'   => $transaction->remain_time
                ]);

                $userUpdate->update(['income'=>$userUpdate->income+((100-$site_income)/100)*$Amount]);
                Transaction::find($transaction->id)->update(['mode'=>'deliver','income'=>((100-$site_income)/100)*$Amount]);

                ## Notification Center
                sendNotification(0,['[c.title]'=>$product->title],get_option('notification_template_buy_new'),'user',$transaction->buyer_id);

                return redirect('/product/'.$transaction->content_id);

            }
            return redirect('/product/'.$transaction->content_id);
        }
        if($request->gateway == 'paytm'){
            $transaction = PaytmWallet::with('receive');
            $Transaction = Transaction::find($transaction->getOrderId());
            $response = $transaction->response();

            if($transaction->isSuccessful()){
                $product = Content::find($Transaction->content_id);
                $userUpdate = User::with('category')->find($Transaction->user_id);
                if($product->private == 1)
                    $site_income = get_option('site_income_private')-$userUpdate->category->off;
                else
                    $site_income = get_option('site_income')-$userUpdate->category->off;

                if(empty($transaction))
                    \redirect('/product/'.$Transaction->content_id);

                $Amount = $transaction->price;

                Sell::insert([
                    'user_id'       => $Transaction->user_id,
                    'buyer_id'      => $Transaction->buyer_id,
                    'content_id'    => $Transaction->content_id,
                    'type'          => $Transaction->type,
                    'created_at'     => time(),
                    'mode'          => 'pay',
                    'transaction_id'=> $Transaction->id,
                    'remiain_time'  => $Transaction->remain_time
                ]);

                $userUpdate->update(['income'=>$userUpdate->income+((100-$site_income)/100)*$Amount]);
                Transaction::find($Transaction->id)->update(['mode'=>'deliver','income'=>((100-$site_income)/100)*$Amount]);

                ## Notification Center
                sendNotification(0,['[c.title]'=>$product->title],get_option('notification_template_buy_new'),'user',$Transaction->buyer_id);

                return redirect('/product/'.$Transaction->content_id);

            }else if($transaction->isFailed()){
                return \redirect('/product/'.$Transaction->content_id)->with('msg',trans('admin.payment_failed'));
            }else if($transaction->isOpen()){
                //Transaction Open/Processing
            }
        }
        if($request->gateway == 'payu'){

        }
        if($request->gateway == 'paystack'){
            $payment = Paystack::getPaymentData();
            if(isset($payment['status']) && $payment['status'] == true){
                $Transaction = Transaction::find($payment['data']['metadata']['transaction']);
                $product = Content::find($Transaction->content_id);
                $userUpdate = User::with('category')->find($Transaction->user_id);
                if($product->private == 1)
                    $site_income = get_option('site_income_private')-$userUpdate->category->off;
                else
                    $site_income = get_option('site_income')-$userUpdate->category->off;

                if(empty($transaction))
                    return redirect('/api/v1/product/verify?mode=failed');

                $Amount = $Transaction->price;

                Sell::insert([
                    'user_id'       => $Transaction->user_id,
                    'buyer_id'      => $Transaction->buyer_id,
                    'content_id'    => $Transaction->content_id,
                    'type'          => $Transaction->type,
                    'created_at'     => time(),
                    'mode'          => 'pay',
                    'transaction_id'=> $Transaction->id,
                    'remain_time'   => $Transaction->remain_time
                ]);

                $userUpdate->update(['income'=>$userUpdate->income+((100-$site_income)/100)*$Amount]);
                Transaction::find($Transaction->id)->update(['mode'=>'deliver','income'=>((100-$site_income)/100)*$Amount]);

                ## Notification Center
                sendNotification(0,['[c.title]'=>$product->title],get_option('notification_template_buy_new'),'user',$Transaction->buyer_id);

                return redirect('/api/v1/product/verify?mode=successfully');
            }else{
                return redirect('/api/v1/product/verify?mode=failed');
            }
        }
        if($request->gateway == 'credit'){
            return view(getTemplate() . '.app.verify');
        }
    }
    public function productPart(Request $request){
        $id     = $request->id;
        $Part   = ContentPart::find($id);
        if(!$Part){
            return $this->error(-1,trans('admin.content_not_found'));
        }
        if($Part->free == 1){
            return $this->stream($id);
        }else{
            $User = $this->checkUserToken($request);
            if(!$User)
                return 'no user';

            if($Part->free == 0 && $User['id'] != $Part->content->user_id) {
                $sell = Sell::where('buyer_id', $User['id'])->where('content_id', $Part->content->id)->count();
                if ($sell == 0) {
                    return 'access denied!';
                }else{
                    return $this->stream($id);
                }
            }
        }

        return $this->error(-1,trans('main.not_purchased_item'));
    }
    public function productComment(Request $request){
        $data = [];
        $User = $this->checkUserToken($request);
        if(!$User)
            return $this->error(-1, trans('main.user_not_found'));

        $duplicate = ContentComment::where('content_id', $request->id)->where('user_id', $User['id'])->where('mode','draft')->count();
        if($duplicate > 0)
            return $this->error(-1,trans('duplicate draft review'));

        ContentComment::create([
            'comment'   => $request->comment,
            'user_id'   => $User['id'],
            'created_at' => time(),
            'name'      => $User['name'],
            'content_id'=> $request->id,
            'parent'    => 0,
            'mode'      => 'draft'
        ]);

        return $this->response($data);
    }
    public function productSearch(Request $request){
        $q = $request->q;
        $currency   = currencySign();
        $data       = [];
        $contents   = Content::with('metas')->where('mode','publish')->where('title','LIKE','%'.$q.'%')->orderBy('id','DESC')->take(20)->get();
        foreach ($contents as $content){
            $meta = arrayToList($content->metas,'option','value');
            $data[] = [
                'id'        => $content->id,
                'title'     => $content->title,
                'thumbnail' => checkUrl($meta['thumbnail']),
                'price'     => isset($meta['price'])?$meta['price']:0,
                'currency'  => $currency,
                'duration'  => isset($meta['duration'])?convertToHoursMins($meta['duration']):0
            ];
        }

        return $this->response($data);
    }
    public function productDiscount(Request $request){
        $productId  = $request->id;
        $code       = $request->code;

        $Product    = Content::with('metas')->find($productId);
        if(!$Product){
            return $this->error(-1, trans('main.not_found'));
        }

        $Price      = $this->productPrice($Product);
        $Discount   = $this->checkDiscount($code, $Price);

        return [
            'status'    => $Discount['status'],
            'price'     => $Price,
            'pay'       => $Discount['price'],
            'discount'  => ($Price > 0 && $Discount['price'] != false)?($Price - $Discount['price']):0,
            'currency'  => currencySign()
        ];
    }
    public function productDownload(Request $request){
        $User = $this->checkUserToken($request);
        if(!$User)
            return redirect('/')->with('msg',trans('main.user_not_found'));
        $user = $User;

        $part = ContentPart::with('content')->where('mode','publish')->find($request->part);
        if(!$part)
            abort(404);

        if($part->free == 0) {
            $sell = Sell::where('buyer_id', $user['id'])->where('content_id', $part->content->id)->count();
            if ($sell == 0)
                abort(404);
        }

        if($part->content->download == 0)
            abort(404);

        $storagePath  = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
        $file = 'source/content-'.$part->content->id.'/video/part-'.$part->id.'.mp4';

        if(file_exists($storagePath.$file))
            return Response::download($storagePath.$file);
        else
            return abort(404);
    }
    public function productDownloaded(Request $request){
        $User = $this->checkUserToken($request);
        if(!$User){
            return redirect('/')->with('msg',trans('main.user_not_found'));
        }

        $buscarRegistro = RegistroDescargas::where('user_id', $User['id'])->where('content_id', $request->product)->get();
        if($buscarRegistro->isEmpty()){
            $updateDownload = RegistroDescargas::create(['user_id' => $User['id'], 'content_id' => $request->product]);
            return $this->response(['result' => 'Guardado.']);
        }else{
            return $this->error(-1, 'El registro ya existe.');
        }


    }
    public function productSupport(Request $request){
        $User = $this->checkUserToken($request);
        if(!$User)
            return redirect('/')->with('msg',trans('main.user_not_found'));
        $user = $User;

        $buy = Sell::where('buyer_id',$user['id'])->where('content_id',$request->content_id)->first();
        if(isset($buy)){
            ContentSupport::create([
                'comment'       => $request->comment,
                'user_id'       => $user['id'],
                'created_at'     => time(),
                'name'          => $user['name'],
                'content_id'    => $request->content_id,
                'mode'          => 'draft',
                'supporter_id'  => $buy->user_id,
                'sender_id'     => $user['id']
            ]);
            return $this->response(['description'=>trans('admin.support_success')]);
        }else {
            return $this->error(-1,trans('admin.support_failed'));
        }
    }
    ## Category ##
    public function category(Request $request){
        $currency   = currencySign();
        $data       = [];
        $contents   = Content::with('metas')->where('mode','publish')->where('category_id',$request->id)->orderBy('id','DESC')->get();
        foreach ($contents as $content){
            $meta = arrayToList($content->metas,'option','value');
            $data[] = [
                'id'        => $content->id,
                'title'     => $content->title,
                'thumbnail' => checkUrl($meta['thumbnail']),
                'price'     => isset($meta['price'])?$meta['price']:0,
                'currency'  => $currency,
                'duration'  => isset($meta['duration'])?convertToHoursMins($meta['duration']):0
            ];
        }

        return $this->response($data);
    }

    ## User Section
    public function userRegister(Request $request){
        $duplicateUser = User::where('username',$request->username)->first();
        $duplicateEmail = User::where('email',$request->email)->first();

        if($duplicateUser)
        {
            return $this->error(-1,trans('main.user_exists'));
        }
        if($duplicateEmail)
        {
            return $this->error(-1,trans('main.user_exists'));
        }
        if($request->password != $request->re_password)
        {
            return $this->error('-1',trans('main.pass_confirmation_same'));
        }

        $newUser = [
            'name'          => $request->name,
            'username'      => $request->username,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'created_at'     => time(),
            'admin'         => 0,
            'mode'          => get_option('user_register_mode','active'),
            'category_id'   => get_option('user_default_category',0),
            'token'         => str::random(24)
        ];
        $newUser = User::create($newUser);

        ## Send Suitable Email For New User ##
        if(get_option('user_register_mode') == 'deactive')
            sendMail(['template' => get_option('user_register_active_email'), 'recipent' => [$newUser->email]]);
        else
            sendMail(['template'=>get_option('user_register_wellcome_email'),'recipent'=>[$newUser->email]]);

        if(get_option('user_register_mode') == 'active')
            return $this->response(['description'=>trans('main.thanks_reg')]);
        else
            return $this->response(['description'=>trans('main.active_account_alert')]);
    }
    public function userRemember(Request $request){
        $str = str::random();
        $update = User::where('email',$request->email)->update(['token'=>$str]);
        if($update) {
            sendMail(['template'=>get_option('user_register_reset_email'),'recipent'=>[$request->email]]);
            return $this->response(['description'=> trans('main.pass_change_link')]);
        }
        else {
            return $this->error('-1', trans('main.user_not_found'));
        }
    }
    public function userLogin(Request $request){
        $username = $request->username;
        $password = $request->password;

        $fundal_category = Usercategories::where('title', 'Fundal')->orWhere('title', 'fundal')->get();
        $fundal = $fundal_category[0]->id;

        $User = User::where(function ($w) use($username, $fundal){
            $w->where('username',$username)->orWhere('email',$username);
        })->where('admin','0')->where('category_id', $fundal)->first();
        //if($User && Hash::check($password, $User->password)){
        if($User){

            if($User->mode != 'active') {
                if (userMeta($User->id, 'blockDate', time()) < time()) {
                    $User->update(['mode'=>'active']);
                } else {
                    $jBlockDate = date('d F Y', userMeta($User->id, 'blockDate', time()));
                    return $this->error(-1, trans('main.access_denied') . $jBlockDate );
                }
            }

            Login::create([
                'user_id'       => $User->id,
                'created_at_sh' => time(),
                'updated_at_sh' => time()
            ]);
            Event::create([
                'user_id'   => $User->id,
                'type'      => 'Login Page',
                'ip'        => $request->ip()
            ]);

            $User->update(['last_view'=>time()]);
            return $this->response(['user'=>$this->userInfo($User->id)]);

        }else{
            return $this->error(-2,trans('main.incorrect_login'));
        }
    }
    public function userInformation(Request $request){
        $User = $this->checkUserToken($request);
        if($User){
            return $this->response(['user'=>$User]);
        }

        return $this->error(-1,trans('main.user_login'));
    }
    public function userSetting(Request $request){
        $User = $this->checkUserToken($request);
        if(!$User)
            return $this->error(-1, trans('main.user_not_found'));

        if(isset($request->password) && ($request->password != $request->re_password))
            return $this->error(-1, trans('main.pass_confirmation_same'));

        if(isset($request->password) && ($request->password == $request->re_password))
            User::find($User['id'])->update(['password'=>encrypt($request->password)]);

        if(isset($request->name) && $request->name != '')
            User::find($User['id'])->update(['name'=>$request->name]);
        if(isset($request->phone) && $request->phone != '')
            setUserMeta($User['id'],'phone', $request->phone);
        if(isset($request->city) && $request->city != '')
            setUserMeta($User['id'],'city', $request->city);
        if(isset($request->age) && $request->age != '')
            setUserMeta($User['id'],'old', $request->age);

        return $this->response(['user'=> $this->userInfo($User['id'])]);
    }
    # Profile
    public function userProfile(Request $request)
    {
        $currency = currencySign();
        $user = $this->checkUserToken($request);
        $id = $request->id;
        $data = [];
        $profile = User::with('usermetas')->find($id);

        if (empty($profile))
            return redirect('/')->with('msg',trans('main.user_not_found'));

        $data['id']         = $profile->id;
        $data['username']   = $profile->username;
        $data['name']       = $profile->name;
        $data['bio']        = '';
        $data['avatar']     = '';
        foreach ($profile->usermetas as $umeta){
            if($umeta->option == 'biography')
                $data['bio'] = $umeta->value;
            if($umeta->option == 'avatar')
                $data['avatar'] = checkUrl($umeta->value);
        }

        $videos             = Content::with('metas')->where('user_id', $id)->where('mode', 'publish')->get();
        $data['follower']   = Follower::where('user_id', $id)->count();
        $articles           = Article::where('user_id', $id)->where('mode', 'publish')->orderBy('id', 'DESC')->get();
        $rates = getRate($profile);
        if ($user) {
            $data['follow'] = Follower::where('follower', $id)->where('user_id', $user['id'])->count();
        } else {
            $data['follow'] = 0;
        }

        $data['duration'] = 0;
        $data['courses']  = count($videos);
        foreach ($videos as $viid) {
            $meta = arrayToList($viid->metas, 'option', 'value');
            $data['videos'][] = [
                'id'        => $viid->id,
                'title'     => $viid->title,
                'date'      => date('Y F d', $viid->created_at),
                'thumbnail' => checkUrl($meta['thumbnail']),
                'currency'  => $currency,
                'duration'  => isset($meta['duration'])?convertToHoursMins($meta['duration']):0,
                'price'     => isset($meta['price'])?$meta['price']:'free'
            ];
            if (isset($meta['duration']))
                $data['duration'] += $meta['duration'];
        }

        foreach ($articles as $article){
            $data['articles'][] = [
                'title' => $article->title,
                'id'    => $article->id,
                'image' => checkUrl($article->image),
                'date'  => date('Y F d', $article->created_at),
                'url'   => url('/').'/blog/mobile/'.$article->id.'?type=article',
            ];
        }

        foreach ($rates as $rate){
            $data['rates'][] = [
                'description'   => $rate['description'],
                'image'         => checkUrl($rate['image']),
                'mode'          => $rate['mode']
            ];
        }

        return $this->response($data);
    }
    public function userProfileFollow(Request $request){
        $User = $this->checkUserToken($request);
        if(!$User)
            return $this->error(-1, trans('main.user_not_found'));

        Follower::create([
            'follower'  => $request->id,
            'user_id'   => $User['id'],
            'type'      => 'profile'
        ]);

        return $this->response([]);
    }
    public function userProfileUnFollow(Request $request){
        $User = $this->checkUserToken($request);
        if(!$User)
            return $this->error(-1, trans('main.user_not_found'));

        Follower::where('user_id', $User['id'])->where('follower', $request->id)->delete();
        return $this->response([]);
    }

    # Support
    public function supportCategory(Request $request){}
    public function supportList(Request $request){
        $data = [];
        $User = $this->checkUserToken($request);
        if(!$User)
            return $this->error(-1, trans('main.user_not_found'));

        $tickets    = Tickets::with(['category','messages'])->where('user_id', $User['id'])->orderBy('id','DESC')->get();
        $contents   = Content::where('user_id', $User['id'])->pluck('id');
        $comments   = ContentComment::with(['user','content'])->where('mode','publish')->whereIn('content_id', $contents->toArray())->get();
        $supports   = ContentSupport::with(['user','content'])->where('mode','publish')->whereIn('content_id', $contents->toArray())->get();


        foreach ($comments as $comment){
            $data['comments'][] = [
                'user'      => $comment->name,
                'course'    => isset($comment->content->title)?$comment->content->title:'',
                'date'      => date('Y F d', $comment->created_at),
                'comment'   => $comment->comment
            ];
        }

        foreach ($supports as $support){
            $data['supports'][] = [
                'user'      => $support->name,
                'course'    => isset($support->content->title)?$support->content->title:'',
                'date'      => date('Y F d', $support->created_at),
                'comment'   => $support->comment
            ];
        }

        foreach ($tickets as $index=>$ticket){
            $data['tickets'][] = [
                'id'        => $ticket->id,
                'title'     => $ticket->title,
                'category'  => $ticket->category,
                'mode'      => $ticket->mode,
                'date'      => date('Y F d', $ticket->created_at),
            ];
            foreach ($ticket->messages as $message){
                $data['tickets'][$index]['messages'][] = [
                    'id'    => $message->id,
                    'msg'   => strip_tags($message->msg),
                    'attach'=> checkUrl($message->attach),
                    'mode'  => $message->mode,
                    'date'  => date('Y F d', $message->created_at),
                    'view'  => $message->view
                ];
            }
        }

        return $this->response($data);
    }
    public function supportMessages(Request $request){
        $data = [];
        $User = $this->checkUserToken($request);
        if(!$User)
            return $this->error(-1, trans('main.user_not_found'));

        $ticket = Tickets::where('user_id', $User['id'])->find($request->id);
        if(!$ticket)
            return $this->error(-1,trans('main.access_denied'));

        $messages = TicketsMsg::where('ticket_id', $request->id)->get();
        foreach ($messages as $message){
            $data['messages'][] = [
                'id'    => $message->id,
                'msg'   => strip_tags($message->msg),
                'attach'=> checkUrl($message->attach),
                'mode'  => $message->mode,
                'date'  => date('Y F d', $message->created_at),
                'view'  => $message->view
            ];
        }

        return $this->response($data);
    }
    public function supportAction(Request $request){
        $User = $this->checkUserToken($request);
        if(!$User)
            return $this->error(-1, trans('main.user_not_found'));

        if($request->action == 'close'){
            $Ticket = Tickets::where('user_id', $User['id'])->find($request->id);
            if(!$Ticket)
                return $this->error(-1, trans('main.access_denied'));

            $Ticket->update(['mode'=>'close']);
            return $this->response([]);
        }
    }
    public function supportReply(Request $request){
        $User = $this->checkUserToken($request);
        if(!$User)
            return $this->error(-1, trans('main.user_not_found'));

        $ticket = Tickets::find($request->ticket);

        $file = null;
        if($request->files->has('file')){
            $name = str_random() . '.' . $request->file('file')->getClientOriginalExtension();
            $request->file('file')->move(getcwd().'/bin/ticket/',$name);
            $file = '/bin/ticket/'.$name;
        }

        TicketsMsg::create([
            'ticket_id' => $request->ticket,
            'msg'       => $request->msg,
            'user_id'   => $User['id'],
            'created_at' => time(),
            'mode'      => 'user',
            'attach'    => $file
        ]);

        if($ticket->mode == 'close'){
            $ticket->update(['mode'=>'open']);
        }

        return $this->response([]);
    }
    public function supportNew(Request $request){
        $User = $this->checkUserToken($request);
        if(!$User)
            return $this->error(-1, trans('main.user_not_found'));

        $file = null;
        if($request->files->has('file')){
            $name = str_random() . '.' . $request->file('file')->getClientOriginalExtension();
            $request->file('file')->move(getcwd().'/bin/ticket/',$name);
            $file = '/bin/ticket/'.$name;
        }

        $newTicket = Tickets::create([
            'title'         => $request->title,
            'user_id'       => $User['id'],
            'created_at'     => time(),
            'mode'          =>'open',
            'category_id'   => 0,
            'attach'        => $file
        ]);

        TicketsMsg::create([
                'ticket_id' => $newTicket->id,
                'msg'       => $request->msg,
                'created_at' => time(),
                'user_id'   => $User['id'],
                'mode'      => 'user',
                'attach'    => $file
        ]);

        ## Notification Center
        sendNotification(0,['[t.title]'=>$request->title],get_option('notification_template_ticket_new'),'user',$User['id']);

        return $this->response([]);

    }

    ## Courses
    public function coursesList(Request $request){
        $currency = currencySign();
        $data = [];
        $User = $this->checkUserToken($request);
        if(!$User)
            return $this->error(-1, trans('main.user_not_found'));


        //$lists = Content::where('user_id',$User['id'])->with(['metas'])->withCount('sells')->orderBy('id','DESC')->get();
        //foreach ($lists as $item){
        //    $meta = arrayToList($item->metas,'option','value');
        //    $data['courses'][] = [
        //        'id'        => $item->id,
        //        'title'     => $item->title,
        //        'thumbnail' => checkUrl($meta['thumbnail']),
        //        'mode'      => $item->mode,
        //        'sales'     => $item->sells_count
        //    ];
        //}

        //return $dates;

        
        $purchases = Sell::with(['content'=>function($q){
            $q->with(['metas', 'parts']);
        },'transaction.balance'])->where('buyer_id',$User['id'])->orderBy('id','DESC')->get();
        
        if($purchases->isEmpty()){
            return $this->response($data, '0');
        }else{
            /*foreach ($purchases as $item){
                if(isset($item->content)) {
                    $meta = arrayToList($item->content->metas, 'option', 'value');
                    //$data['asignados'][] = [
                    //    'id'        => $item->content->id,
                    //    'title'     => $item->content->title,
                    //    'thumbnail' => checkUrl($meta['thumbnail']),
                    //    //'price'     => isset($meta['price']) ? $meta['price'] : 'free',
                    //    //'amount'    => isset($meta['price']) ? $meta['price'] : 'free',
                    //    //'currency'  => $currency,
                    //    //'date'      => date('Y F d | H:i', $item->created_at),
                    //    'parts'     => $item->content->parts
                    //];
                    foreach($item->content->parts as $part){

                        $date = $part->initial_date;
                        $content_data = [
                            'content_id' => $item->content->id,
                            'content_title' => $item->content->title,
                            'thumbnail' => checkUrl($meta['thumbnail']),
                            'part_id'    => $part->id,
                            'part_title' => $part->title,
                            'initial_date' => $part->initial_date,
                            'limit_date' => $part->limit_date
                        ];

                        $dates[] = ["title" => $date, "data" => [$content_data]];
                    }
                }
            }*/

            $dates = array();

            $purchases_array = Sell::where('buyer_id',$User['id'])->pluck('content_id')->toArray();

            //$now = Carbon::now();
            //$weekStartDate = $now->startOfWeek()->format('Y-m-d');
            //$weekEndDate = $now->endOfWeek()->format('Y-m-d');
            //return $weekStartDate.' -- '.$weekEndDate;

            $ya_realizado = ProgresoAlumno::where('user_id', $User['id'])->whereIn('content_id', $purchases_array)->pluck('part_id')->toArray();

            $courses = Content::whereIn('id', $purchases_array)->where('content_type', 'Fundal')->select(['id', 'title', 'content', 'category_id', 'type'])->get();

            foreach($courses as $course){
                $parts = ContentPart::where('content_id', $course->id)->whereNotIn('id', $ya_realizado)->select(['id as part_id', 'title as part_title', 'initial_date', 'limit_date', 'content_id', 'zoom_meeting', 'date as zoom_date', 'time as zoom_time'])->get();
                foreach($parts as $part){
                    $descargado = RegistroDescargas::where('user_id', $User['id'])->where('content_id', $part->content_id)->get();
                    $content = Content::where('id', $part->content_id)->with('metas')->first();
                    $meta = arrayToList($content->metas, 'option', 'value');
                    $part->part_title = isset($part->zoom_meeting) ? $part->part_title.' - live' : $part->part_title;
                    $part->content_title = $content->title;
                    $part->thumbnail = isset($part->zoom_meeting) ? (isset($meta['thumbnail']) ? checkUrl($meta['thumbnail']) : 'https://checkmybroadbandspeed.online/wp-content/uploads/Zoom-icon-logo1.png') : (isset($meta['thumbnail']) ? checkUrl($meta['thumbnail']) : 'sin thumbnail');
                    $part->downloaded = $descargado->isEmpty() ? false : true;
                    $part->type = isset($part->zoom_meeting) ? 'zoom' : 'course';
                }

                $course->parts = $parts;
            }

            //$parts_data = ContentPart::whereBetween('initial_date', array($weekStartDate, $weekEndDate))->whereIn('content_id', $purchases_array)->whereNotIn('id', $ya_realizado)->select(['id as part_id', 'title as part_title', 'initial_date', 'limit_date', 'content_id'])->get();

            /*foreach($parts_data as $part){
                $descargado = RegistroDescargas::where('user_id', $User['id'])->where('content_id', $part->content_id)->get();
                $content = Content::where('id', $part->content_id)->with('metas')->first();
                $meta = arrayToList($content->metas, 'option', 'value');
                $part->content_title = $content->title;
                $part->thumbnail = isset($meta['thumbnail']) ? checkUrl($meta['thumbnail']) : 'sin thumbnail';
                $part->downloaded = $descargado->isEmpty() ? false : true;
            }*/

            /*$parts_dates = ContentPart::whereIn('content_id', $purchases_array)->distinct('initial_date')->pluck('initial_date');
            
            if(!$parts_data->isEmpty()){
                $dates[] = ["title" => Carbon::parse($weekStartDate)->format('d-m-Y').' al '.Carbon::parse($weekEndDate)->format('d-m-Y'), "data" => $parts_data];
            }*/

            return $this->response($courses);

            setlocale(LC_ALL, 'es_ES');
        }
    }
    ##Videoteca
    public function videoteca(Request $request){
        $currency = currencySign();
        $data = [];
        $User = $this->checkUserToken($request);
        if(!$User)
            return $this->error(-1, trans('main.user_not_found'));


        //$lists = Content::where('user_id',$User['id'])->with(['metas'])->withCount('sells')->orderBy('id','DESC')->get();
        //foreach ($lists as $item){
        //    $meta = arrayToList($item->metas,'option','value');
        //    $data['courses'][] = [
        //        'id'        => $item->id,
        //        'title'     => $item->title,
        //        'thumbnail' => checkUrl($meta['thumbnail']),
        //        'mode'      => $item->mode,
        //        'sales'     => $item->sells_count
        //    ];
        //}

        //return $dates;

        $content = Content::where('mode', 'publish')->where('content_type', 'Videoteca')->with(['metas', 'parts'])->get();
        
        if($content->isEmpty()){
            return $this->response($data, '0');
        }else{
            /*foreach ($purchases as $item){
                if(isset($item->content)) {
                    $meta = arrayToList($item->content->metas, 'option', 'value');
                    //$data['asignados'][] = [
                    //    'id'        => $item->content->id,
                    //    'title'     => $item->content->title,
                    //    'thumbnail' => checkUrl($meta['thumbnail']),
                    //    //'price'     => isset($meta['price']) ? $meta['price'] : 'free',
                    //    //'amount'    => isset($meta['price']) ? $meta['price'] : 'free',
                    //    //'currency'  => $currency,
                    //    //'date'      => date('Y F d | H:i', $item->created_at),
                    //    'parts'     => $item->content->parts
                    //];
                    foreach($item->content->parts as $part){

                        $date = $part->initial_date;
                        $content_data = [
                            'content_id' => $item->content->id,
                            'content_title' => $item->content->title,
                            'thumbnail' => checkUrl($meta['thumbnail']),
                            'part_id'    => $part->id,
                            'part_title' => $part->title,
                            'initial_date' => $part->initial_date,
                            'limit_date' => $part->limit_date
                        ];

                        $dates[] = ["title" => $date, "data" => [$content_data]];
                    }
                }
            }*/

            $purchases_array = Content::where('mode', 'publish')->where('content_type', 'Videoteca')->pluck('id')->toArray();

            //$now = Carbon::now();
            //$weekStartDate = $now->startOfWeek()->format('Y-m-d');
            //$weekEndDate = $now->endOfWeek()->format('Y-m-d');
            //return $weekStartDate.' -- '.$weekEndDate;

            $ya_realizado = ProgresoAlumno::where('user_id', $User['id'])->whereIn('content_id', $purchases_array)->pluck('part_id')->toArray();

            $courses = Content::whereIn('id', $purchases_array)->where('content_type', 'Videoteca')->select(['id', 'title', 'content', 'category_id', 'type'])->get();

            foreach($courses as $course){
                $parts = ContentPart::where('content_id', $course->id)->whereNotIn('id', $ya_realizado)->select(['id as part_id', 'title as part_title', 'content_id', 'zoom_meeting', 'date as zoom_date', 'time as zoom_time'])->get();
                foreach($parts as $part){
                    $descargado = RegistroDescargas::where('user_id', $User['id'])->where('content_id', $part->content_id)->get();
                    $content = Content::where('id', $part->content_id)->with('metas')->first();
                    $meta = arrayToList($content->metas, 'option', 'value');
                    $part->part_title = isset($part->zoom_meeting) ? $part->part_title.' - live' : $part->part_title;
                    $part->content_title = $content->title;
                    $part->thumbnail = isset($part->zoom_meeting) ? (isset($meta['thumbnail']) ? checkUrl($meta['thumbnail']) : 'https://checkmybroadbandspeed.online/wp-content/uploads/Zoom-icon-logo1.png') : (isset($meta['thumbnail']) ? checkUrl($meta['thumbnail']) : 'sin thumbnail');
                    $part->downloaded = $descargado->isEmpty() ? false : true;
                    $part->type = isset($part->zoom_meeting) ? 'zoom' : 'course';
                }

                $course->parts = $parts;
            }

            //$parts_data = ContentPart::whereBetween('initial_date', array($weekStartDate, $weekEndDate))->whereIn('content_id', $purchases_array)->whereNotIn('id', $ya_realizado)->select(['id as part_id', 'title as part_title', 'initial_date', 'limit_date', 'content_id'])->get();

            /*foreach($parts_data as $part){
                $descargado = RegistroDescargas::where('user_id', $User['id'])->where('content_id', $part->content_id)->get();
                $content = Content::where('id', $part->content_id)->with('metas')->first();
                $meta = arrayToList($content->metas, 'option', 'value');
                $part->content_title = $content->title;
                $part->thumbnail = isset($meta['thumbnail']) ? checkUrl($meta['thumbnail']) : 'sin thumbnail';
                $part->downloaded = $descargado->isEmpty() ? false : true;
            }*/

            /*$parts_dates = ContentPart::whereIn('content_id', $purchases_array)->distinct('initial_date')->pluck('initial_date');
            
            if(!$parts_data->isEmpty()){
                $dates[] = ["title" => Carbon::parse($weekStartDate)->format('d-m-Y').' al '.Carbon::parse($weekEndDate)->format('d-m-Y'), "data" => $parts_data];
            }*/

            return $this->response($courses);

            setlocale(LC_ALL, 'es_ES');
        }
    }


    ## Financial
    public function financialList(Request $request){
        $currency = currencySign();
        $data = [];
        $User = $this->checkUserToken($request);
        if(!$User)
            return $this->error(-1, trans('main.user_not_found'));

        $list       = Sell::with(['content','transaction'])->where('user_id',$User['id'])->where('mode','pay')->orderBy('id','DESC')->get();
        $documents  = Balance::where('user_id', $User['id'])->orderBy('id','DESC')->get();
        foreach ($list as $item){
            $data['sells'][] = [
                'title'     => isset($item->content->title)?$item->content->title:'',
                'date'      => date('Y F d | H:i', $item->created_at),
                'income'    => $item->transaction->income,
                'currency'  => $currency
            ];
        }
        foreach ($documents as $item){
            $data['documents'][] = [
                'title'   => $item->title,
                'date'    => date('Y F d | H:i', $item->created_at),
                'type'    => $item->type,
                'amount'  => $item->price,
                'currency'=> $currency
            ];
        }

        $data['income']     = $User['income'];
        $data['credit']     = $User['credit'];
        $data['currency']   = $currency;

        return $this->response($data);
    }
    ## Channel
    public function channelList(Request $request){
        $data = [];
        $User = $this->checkUserToken($request);
        if(!$User)
            return $this->error(-1, trans('main.user_not_found'));

        $channels = Channel::withCount('contents')->where('user_id',$User['id'])->get();
        foreach ($channels as $item){
            $data['channels'][] = [
                'title'     => $item->title,
                'thumbnail' => checkUrl($item->image),
                'mode'      => $item->mode,
                'contents'  => $item->contents_count
            ];
        }

        return $this->response($data);
    }
    public function channelNew(Request $request){}

    ## Wallet
    public function walletPay(Request $request){
        $User = $this->checkUserToken($request);
        if(!$User)
            return redirect('/')->with('msg',trans('main.user_not_found'));
        $user = $User;

        if (!is_numeric($request->price) || $request->price == 0)
            return redirect('/')->with('msg', trans('main.number_only'));

        if($request->type == 'paypal') {
            $payer = new Payer();
            $payer->setPaymentMethod('paypal');
            $item_1 = new Item();
            $item_1->setName('charge account')
                ->setCurrency('USD')
                ->setQuantity(1)
                ->setPrice($request->price);
            $item_list = new ItemList();
            $item_list->setItems(array($item_1));
            $amount = new Amount();
            $amount->setCurrency('USD')
                ->setTotal($request->price);
            $transaction = new \PayPal\Api\Transaction();
            $transaction->setAmount($amount)
                ->setItemList($item_list)
                ->setDescription('Charge Your Wallet');
            $redirect_urls = new RedirectUrls();
            $redirect_urls->setReturnUrl(url('/').'/api/v1/user/wallet/verify?gateway=paypal')
                ->setCancelUrl(url('/').'/payment/wallet/cancel');
            $payment = new Payment();
            $payment->setIntent('Sale')
                ->setPayer($payer)
                ->setRedirectUrls($redirect_urls)
                ->setTransactions(array($transaction));
            try {
                $payment->create($this->_api_context);
            } catch (\PayPal\Exception\PPConnectionException $ex) {
                if (\Config::get('app.debug')) {
                    \Session::put('error', 'Connection timeout');
                    return Redirect::route('paywithpaypal');
                } else {
                    \Session::put('error', 'Some error occur, sorry for inconvenient');
                    return Redirect::route('paywithpaypal');
                }
            }
            foreach ($payment->getLinks() as $link) {
                if ($link->getRel() == 'approval_url') {
                    $redirect_url = $link->getHref();
                    break;
                }
            }
            TransactionCharge::create([
                'user_id'   => $User['id'],
                'price'     => $request->price,
                'mode'      => 'pending',
                'authority' => $payment->getId(),
                'created_at' => time(),
                'bank'      => 'paypal'
            ]);
            /** add payment ID to session **/
            \Session::put('paypal_payment_id', $payment->getId());
            if (isset($redirect_url)) {
                /** redirect to paypal **/
                return Redirect::away($redirect_url);
            }
            \Session::put('error', 'Unknown error occurred');
            return Redirect::route('paywithpaypal');
        }
        if($request->type == 'income'){
            if($request->price <= $user['income']){
                User::find($user['id'])->update([
                    'income'=>$user['income']-$request->price,
                    'credit'=>$user['credit']+$request->price
                ]);
                Balance::create([
                    'title'=>trans('main.user_account_charge'),
                    'description'=>trans('main.account_charged'),
                    'type'=>'add',
                    'price'=>$request->price,
                    'mode'=>'auto',
                    'user_id'=>$user['id'],
                    'exporter_id'=>0,
                    'created_at'=>time()
                ]);
                Balance::create([
                    'title'=>trans('main.income_deduction'),
                    'description'=>trans('main.charge_transfer'),
                    'type'=>'minus',
                    'price'=>$request->price,
                    'mode'=>'auto',
                    'user_id'=>$user['id'],
                    'exporter_id'=>0,
                    'created_at'=>time()
                ]);
                return redirect()->back()->with('msg',trans('main.account_charged_success'));
            }else{
                return redirect()->back()->with('msg',trans('main.income_not_enough'));
            }
        }
        if($request->type == 'paytm'){
            $payment = PaytmWallet::with('receive');
            $Transaction = TransactionCharge::create([
                'user_id'   => $user['id'],
                'price'     => $request->price,
                'mode'      => 'pending',
                'authority' => $payment->getId(),
                'created_at' => time(),
                'bank'      => 'paytm'
            ]);
            $payment->prepare([
                'order'         => $Transaction->id,
                'user'          => $user['id'],
                'email'         => $user['email'],
                'mobile_number' => '00187654321',
                'amount'        => $Transaction->price,
                'callback_url'  => url('/').'/api/v1/user/wallet/verify?gateway=paytm'
            ]);

            return $payment->receive();
        }
        if($request->type == 'paystack'){
            $payStack    = new \Unicodeveloper\Paystack\Paystack();
            $Transaction = TransactionCharge::create([
                'user_id'   => $user['id'],
                'price'     => $request->price,
                'mode'      => 'pending',
                'authority' => 0,
                'created_at' => time(),
                'bank'      => 'paystack'
            ]);
            $payStack->getAuthorizationResponse([
                "amount"        => $request->price,
                "reference"     => Paystack::genTranxRef(),
                "email"         => $user['email'],
                "callback_url"  => url('/').'/api/v1/user/wallet/verify?gateway=paystack',
                'metadata'      => json_encode(['transaction'=>$Transaction->id])
            ]);
            return redirect($payStack->url);
        }

        return redirect()->back()->with('msg',trans('main.feature_disabled'));
    }
    public function walletVerify(Request $request){
        if(isset($request->gateway) && $request->gateway == 'paypal') {
            $payment_id = \Session::get('paypal_payment_id');
            \Session::forget('paypal_payment_id');
            if (empty($request->PayerID) || empty($request->token)) {
                \Session::put('error', 'Payment failed');
                return view(getTemplate() . '.app.wallet',['mode'=>'failed']);
            }
            $payment = Payment::get($payment_id, $this->_api_context);
            $execution = new PaymentExecution();
            $execution->setPayerId($request->PayerID);
            $result = $payment->execute($execution, $this->_api_context);
            if ($result->getState() == 'approved') {
                $transaction = TransactionCharge::where('mode', 'pending')->where('authority', $payment_id)->first();
                $Amount = $transaction->price;
                Balance::create([
                    'title' => 'Wallet',
                    'description' => 'Wallet charge',
                    'type' => 'add',
                    'price' => $Amount,
                    'mode' => 'auto',
                    'user_id' => $transaction->user_id,
                    'exporter_id' => 0,
                    'created_at' => time()
                ]);
                $userUpdate = User::find($transaction->user_id);
                $userUpdate->update(['credit' => $userUpdate->credit + $Amount]);

                TransactionCharge::find($transaction->id)->update(['mode' => 'deliver']);
                return view(getTemplate() . '.app.wallet',['mode'=>'successfully']);
            }
        }
        if(isset($request->gateway) && $request->gateway == 'paytm'){
            $transaction = PaytmWallet::with('receive');
            $Transaction = TransactionCharge::find($transaction->getOrderId());

            if($transaction->isSuccessful()){
                $Amount = $Transaction->price;
                Balance::create([
                    'title' => 'Wallet',
                    'description' => 'Wallet',
                    'type' => 'add',
                    'price' => $Amount,
                    'mode' => 'auto',
                    'user_id' => $Transaction->user_id,
                    'exporter_id' => 0,
                    'created_at' => time()
                ]);
                $userUpdate = User::find($Transaction->user_id);
                $userUpdate->update(['credit' => $userUpdate->credit + $Amount]);

                TransactionCharge::find($Transaction->id)->update(['mode' => 'deliver']);
                return view(getTemplate() . '.app.wallet',['mode'=>'successfully']);
            }else{
                return view(getTemplate() . '.app.wallet',['mode'=>'failed']);
            }
        }
        if(isset($request->gateway) && $request->gateway == 'paystack'){
            $payment = Paystack::getPaymentData();
            if(isset($payment['status']) && $payment['status'] == true){
                $Transaction = TransactionCharge::find($payment['data']['metadata']['transaction']);
                $Amount = $Transaction->price;
                Balance::create([
                    'title' => 'Wallet',
                    'description' => 'Wallet charge',
                    'type' => 'add',
                    'price' => $Amount,
                    'mode' => 'auto',
                    'user_id' => $Transaction->user_id,
                    'exporter_id' => 0,
                    'created_at' => time()
                ]);
                $userUpdate = User::find($Transaction->user_id);
                $userUpdate->update(['credit' => $userUpdate->credit + $Amount]);

                TransactionCharge::find($Transaction->id)->update(['mode' => 'deliver']);
                return view(getTemplate() . '.app.wallet',['mode'=>'successfully']);
            }else{
                return view(getTemplate() . '.app.wallet',['mode'=>'failed']);
            }
        }

        return view(getTemplate() . '.app.wallet',['mode'=>'failed']);
    }

    /** Funciones añadidas para Tzenik */

    public function updateUserProgress(Request $request){
        $user = $this->checkUserToken($request);
        $content_id = $request->product;
        $part_id = $request->part;
        if(!$user){
            return $this->error(-1, trans('main.user_not_found'));
        }

        if(!isset($content_id) || !isset($part_id)){
            return $this->error(-1, trans('Ingrese los datos correctamente'));
        }else{
            $progreso_parte = ProgresoAlumno::where('user_id', $user['id'])->where('content_id', $content_id)->where('part_id', $part_id)->get();
            if($progreso_parte->isEmpty()){
                $registrar_progreso = ProgresoAlumno::create(['user_id' => $user['id'], 'content_id' => $content_id, 'part_id' => $part_id, 'date' => Carbon::now()->format('Y-m-d'), 'time' => Carbon::now()->format('H:i')]);
                return $this->response(['estatus' => 'Progreso actualizado correctamente.']);
            }else{
                return $this->error(-1, trans('Este registro ya existe.'));
            }
        }
    }

    public function userCalendar(Request $request){
        $user = $this->checkUserToken($request);
        if(!$user){
            return $this->error(-1, trans('main.user_not_found'));
        }
        //$events = CalendarEvents::where('user_id', $user['id'])->get();
        //foreach($events as $event){
        //    $product = Content::find($event->product_id);
        //    $event->product_name = $product->title;
        //    $event->product_desc = $product->content;
        //}
        //return $this->response($events);

        $dates = CalendarEvents::where('user_id', $user['id'])->distinct('date')->pluck('date');

        //$dates_array = CalendarEvents::where('user_id', $user['id'])->distinct('date')->pluck('date')->keyBy('date')->toArray();

        $dates_array = array();

        //$events_by_date = array();
        /*foreach($dates as $date){
            $events = CalendarEvents::where('user_id', $user['id'])->where('date', $date)->select(['id', 'user_id', 'product_id', 'type', 'content'])->first();
            foreach($events as $event){
                $product = Content::find($event->product_id);
                $hour_pos = strpos($event->content, "H");
                $hour = substr($event->content, 9);
                unset($event['content']);
                $event->name = $product->title;
                $event->desc = $product->content;
                $event->start = $date.'T'.date("H:i", strtotime($hour));
                $event->selected = true;
            }
            $dates_array[$date] = $events;
            //array_push($events_by_date, array($date => $events));
        }¨*/

        foreach($dates as $date){
            $event = CalendarEvents::where('user_id', $user['id'])->where('date', $date)->select(['product_id', 'type', 'content'])->get();

            foreach($event as $evento){
                $content = Content::find($evento->product_id);
                $evento->title = $content->title;
            }
            
            $event->selected = true;
            
            $dates_array[$date] = ['marked' => true, 'eventos' => $event];
            //array_push($events_by_date, array($date => $events));
        }

        //$events = CalendarEvents::where('user_id', $user['id'])->orderBy('date', 'asc')->groupBy('date')->get();
        //var_dump($events_by_date);
        //return $this->response($events_by_date);
        //return $dates_array;
        return $this->response($dates_array);
    }
    public function addToCalendar(Request $request){
        $user = $this->checkUserToken($request);
        if(!$user){
            return $this->error(-1, trans('main.user_not_found'));
        }
        CalendarEvents::create([
            'user_id' => $user['id'],
            'product_id' => $request->product_id,
            'date' => $request->date,
            'type' => $request->type,
            'content' => $request->content,
        ]);

        return $this->response(['event_status' => 'saved']);
    }
    public function quizzesResults(Request $request){
        $user = $this->checkUserToken($request);
        if(!$user){
            return $this->error(-1, trans('main.user_not_found'));
        }
        $results = QuizResult::where('student_id', $user['id'])->with('quiz')->get();

        foreach($results as $result){
            $content = Content::find($result->quiz->content_id);
            $result->quiz->content_name = $content->title;
        }

        return $this->response($results);
    }
    public function quizResult(Request $request){
        $user = $this->checkUserToken($request);
        if(!$user){
            return $this->error(-1, trans('main.user_not_found'));
        }
        $results = QuizResult::where('student_id', $user['id'])->where('quiz_id', $request->quiz)->get();

        return $this->response($results);
    }
    public function QuizzesStoreResult(Request $request)
    {
        $user = $this->checkUserToken($request);
        $quiz = Quiz::where('id', $request->quiz_id)->first();
        if ($quiz) {
            $results = $request->get('question');
            $quiz_result_id = $request->get('quiz_result_id');

            if (!empty($quiz_result_id)) {
                $quiz_result = QuizResult::where('id', $quiz_result_id)
                    ->where('student_id', $user['id'])
                    ->first();

                if (!empty($quiz_result)) {
                    $pass_mark = $quiz->pass_mark;
                    $total_mark = 0;
                    $status = '';

                    foreach ($results as $question_id => $result) {
                        if (!is_array($result)) {
                            unset($results[$question_id]);
                        } else {
                            $question = QuizzesQuestion::where('id', $question_id)
                                ->where('quiz_id', $quiz->id)
                                ->first();
                            if ($question and !empty($result['answer'])) {
                                $answer = QuizzesQuestionsAnswer::where('id', $result['answer'])
                                    ->where('question_id', $question->id)
                                    ->where('user_id', $quiz->user_id)
                                    ->first();

                                $results[$question_id]['status'] = false;
                                $results[$question_id]['grade'] = $question->grade;

                                if ($answer and $answer->correct) {
                                    $results[$question_id]['status'] = true;
                                    $total_mark += (int)$question->grade;
                                }

                                if ($question->type == 'descriptive') {
                                    $status = 'waiting';
                                    //$total_mark += (int)$question->grade;
                                }
                            }
                        }
                    }

                    if (empty($status)) {
                        $status = ($total_mark >= $pass_mark) ? 'pass' : 'fail';
                    }

                    $quiz_result->update([
                        'results' => json_encode($results),
                        'user_grade' => $total_mark,
                        'status' => $status,
                        'created_at' => time()
                    ]);

                    return $this->response(['result_status' => 'saved']);
                }
            }
        }
        return $this->error(-1, trans('El contenido no existe.'));
    }
    public function quizzDo(Request $request)
    {
        $user = $this->checkUserToken($request);
        $quiz_id = $request->quiz_id;

        $quiz = Quiz::where('id', $quiz_id)
            ->with(['questions' => function ($query) {
                $query->with(['questionsAnswers']);
            }, 'questionsGradeSum'])
            ->first();

        if ($quiz) {
            $attempt_count = $quiz->attempt;
            $userQuizDone = QuizResult::where('quiz_id', $quiz->id)
                ->where('student_id', $user['id'])
                ->get();
            $status_pass = false;
            foreach ($userQuizDone as $result) {
                if ($result->status == 'pass') {
                    $status_pass = true;
                }
            }

            if (!isset($quiz->attempt) or (count($userQuizDone) < $attempt_count and !$status_pass)) {
                $newQuizStart = QuizResult::create([
                    'quiz_id' => $quiz->id,
                    'student_id' => $user['id'],
                    'results' => '',
                    'user_grade' => '',
                    'status' => 'waiting',
                    'created_at' => time()
                ]);

                $data = [
                    'quiz' => $quiz,
                    'newQuizStart' => $newQuizStart
                ];

                //return view(getTemplate() . '.user.quizzes.start', $data);
                return $this->response($data);
            } else {
                return $this->error(-1, trans('Sin acceso al quiz.'));
                //return back()->with('msg', trans('main.cant_start_quiz'));
            }
        }
        abort(404);
    }

    public function chatRooms(Request $request){
        $user = $this->checkUserToken($request);
        $result = [];
        $id = $user['id'];
        //$chats = Chat_Chats::with('users_in_chat')->orderBy('id', 'DESC')->get();
        $chats = Chat_Chats::leftjoin('chat_users_in_chat', 'chat_chats.id', '=', 'chat_users_in_chat.chat_id')->where('chat_users_in_chat.user_id', $id)->select('chat_chats.id', 'chat_chats.name', 'chat_chats.published')->orderBy('chat_chats.id', 'DESC')->get();
        /*foreach($chats as $chat){
            $result[$chat] = $chat['id'];
            $result[$chat]['name'] = $chat['name'];
        }*/
        //return $result;
        return $chats;
    }

    public function chat_getMessages(Request $request){
        $user = $this->checkUserToken($request);
        $id = $user['id'];
        $name = $user['name'];
        $chat_id = $request->chat_id;
        $chats = Chat_Chats::leftjoin('chat_users_in_chat', 'chat_chats.id', '=', 'chat_users_in_chat.chat_id')->where('chat_users_in_chat.user_id', $id)->select('chat_chats.id', 'chat_chats.name')->orderBy('chat_chats.id', 'DESC')->get();
        //$messages = Chat_Messages::with('message_owner')->where('chat_id', $chat_id)->orderBy('id', 'DESC')->get();
        $messages = Chat_Messages::join('users', 'users.id', '=', 'chat_messages.sender')->select('chat_messages.message', 'chat_messages.id', 'users.name')->where('chat_messages.chat_id', $chat_id)->orderBy('chat_messages.id', 'ASC')->get();
        //return view(getTemplate() . '.user.chat.chat', ['chats' => $chats, 'messages' => $messages, 'this_chat' => $chat_id, 'this_user' => $name]);
        return $messages;
    }

    public function chat_sendMessage(Request $request){
        $user = $this->checkUserToken($request);
        $chat_id = $request->chat_id;
        $message = $request->message;
        //$data = $request->except('_token');
        //$data['sender'] = $user->id;
        //$data['chat_id'] = $chat_id;
        //$message = $data['message'];
        //$redis = LRedis::connection();
        //$redis->publish('messageData', ['message' => $message, 'chat_id' => $chat_id, 'sender' => $user->id]);
        $message_id = Chat_Messages::insertGetId(['message' => $message, 'chat_id' => $chat_id, 'sender' => $user['id']]);
        return $message_id;
        
    }

    public function homeworks(Request $request){

        $User = $this->checkUserToken($request);

        if(!$User)
            return $this->error(-1, trans('main.user_not_found'));

        $purchases = Sell::where('buyer_id',$User['id'])->select(['content_id'])->get();

        if($purchases->isEmpty()){
            return $this->response($data, '0');
        }else{

            $purchases_array = $purchases->toArray();

            $courses = Content::whereIn('id', $purchases_array)->where('content_type', 'Fundal')->select(['id', 'title'])->get();

            //return $courses;

            foreach($courses as $course){
                $homework = Homeworks::where('content_id', $course->id)->get();
                $course->homeworks = $homework;
            }

            return $this->response($courses);
        }

    }

    public function uploadHomework(Request $request){
        $User = $this->checkUserToken($request);

        return $User;

        $image = $request->file('homeworks');
        $course = $request->product;
        $part = $request->part;

        return $request;

        $counter = 0;

        if(!$User){
            return $this->error(-1, trans('main.user_not_found'));
        }

        $extension = $image->getClientOriginalExtension();
        $name = $User['name'].'-'.$course.'-'.$part.'-('.time().').'.$extension;

        $image->move(public_path().'/bin/tareas/'.$course.'/'.$User['name'].'/'.$part, $name);

        HomeworksUser::insert([
            'user_id' => $User['id'],
            'content_id' => $course,
            'part_id' => $part,
            'route' => '/bin/tareas/'.$course.'/'.$User['name'].'/'.$part.'/'.$name,
        ]);

        /*foreach($homeworks as $homework){
            $extension = $homework->getClientOriginalExtension();
            $name = $User['name'].'-'.$course.'-'.$part.'-('.time().').'.$extension;

            $homework->move(public_path().'/bin/tareas/'.$course.'/'.$User['name'].'/'.$part, $name);

            HomeworksUser::insert([
                'user_id' => $User['id'],
                'content_id' => $course,
                'part_id' => $part,
                'route' => '/bin/tareas/'.$course.'/'.$User['name'].'/'.$part.'/'.$name,
            ]);
        }*/

        return $this->response(['image' => '/bin/tareas/'.$course.'/'.$User['name'].'/'.$part.'/'.$name]);
        //return $this->response(['image' => '/bin/tareas/'.$course.'/'.$User['name'].'/'.$part.'/test']);
    }

    public function subirTarea(Request $request){
        $user = $this->checkUserToken($request);
        $image = $request->file('file');
        $course = $request->product;
        $part = $request->part;

        foreach($request->file('file') as $homework){
            $extension = $homework->getClientOriginalExtension();
            $name = $user['name'].'-'.$course.'-'.$part.'-('.time().').'.$extension;

            $homework->move(public_path().'/bin/tareas/'.$course.'/'.$user['name'].'/'.$part, $name);

            HomeworksUser::insert([
                'user_id' => $user['id'],
                'content_id' => $course,
                'part_id' => $part,
                'route' => '/bin/tareas/'.$course.'/'.$user['name'].'/'.$part.'/'.$name,
            ]);
        }
        
        /*$extension = $image->getClientOriginalExtension();
        $name = $user['name'].'-'.$course.'-'.$part.'-('.time().').'.$extension;

        $image->move(public_path().'/bin/tareas/'.$course.'/'.$user['name'].'/'.$part, $name);

        HomeworksUser::insert([
            'user_id' => $user['id'],
            'content_id' => $course,
            'part_id' => $part,
            'route' => '/bin/tareas/'.$course.'/'.$user['name'].'/'.$part.'/'.$name,
        ]);*/
    
        return response()->json(['success' => 'success']);
        
    }
}
