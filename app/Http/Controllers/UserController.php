<?php

namespace App\Http\Controllers;

use Anand\LaravelPaytmWallet\Facades\PaytmWallet;
use App\Classes\Vimeo;
use App\Models\AdsPlan;
use App\Models\AdsRequest;
use App\Models\Article;
use App\Models\ArticleRate;
use App\Models\Balance;
use App\Models\Certificate;
use App\Models\CertificateTemplate;
use App\Models\Channel;
use App\Models\ChannelRequest;
use App\Models\ChannelVideo;
use App\Models\Content;
use App\Models\ContentCategory;
use App\Models\ContentComment;
use App\Models\ContentMeta;
use App\Models\ContentPart;
use App\Models\ContentRate;
use App\Models\ContentSupport;
use App\Models\DiscountContent;
use App\Models\Follower;
use App\Models\MeetingDate;
use App\Models\MeetingLink;
use App\Models\Notification;
use App\Models\Quiz;
use App\Models\QuizResult;
use App\Models\QuizzesQuestion;
use App\Models\QuizzesQuestionsAnswer;
use App\Models\Record;
use App\Models\Requests;
use App\Models\Sell;
use App\Models\SellRate;
use App\Models\Tickets;
use App\Models\TicketsCategory;
use App\Models\TicketsMsg;
use App\Models\TicketsUser;
use App\Models\Transaction;
use App\Models\TransactionCharge;
use App\Models\Usermeta;
use App\Models\UserRate;
use App\User;
use Carbon\Carbon;

use App\Models\CalendarEvents;
use App\Models\Forum;
use App\Models\ForumCategory;
use App\Models\ForumComments;
use App\Models\Chat_Chats;
use App\Models\Chat_Messages;
use App\Models\Chat_UsersInChat;
use Illuminate\Support\Facades\Http;
use App\Models\ProgresoAlumno;
use App\Models\Usercategories;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Redis;
use LRedis;

use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Laravel\Socialite\Facades\Socialite;
use PayPal\Api\Amount;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Razorpay\Api\Api;
use App\Models\Homeworks;
use App\Models\HomeworksUser;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use File;

class UserController extends Controller
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

    public function dashboard()
    {
        $user = (auth()->check()) ? auth()->user() : false;
        if (!$user) {
            return redirect('/login');
        }

        $userNotification = Notification::where(function ($q) {
            $q->where('recipent_type', 'all');
        })->orWhere(function ($q) use ($user) {
            $q->where('recipent_type', 'category')->where('recipent_list', $user->category_id);
        })->orWhere(function ($q) use ($user) {
            $q->where('recipent_type', 'user')->where('recipent_list', $user->id);
        })->limit(8)
            ->orderBy('id', 'DESC')
            ->get();

        $sellQuery = Sell::where('mode', 'pay');

        $userBuy = $sellQuery->where('buyer_id', $user->id)
            ->with('content')
            ->orderBy('id', 'DESC')
            ->take(5)
            ->get();


        $userBuyCount = $sellQuery->where('buyer_id', $user->id)->count();

        $userSell = $sellQuery->where('user_id', $user->id)
            ->with(['content' => function ($q) {
                $q->with('metas');
            }])
            ->get();

        $userMetas = Usermeta::where('user_id', $user->id)->pluck('value', 'option')->all();

        $sell_rate = UserRate::where('mode', 'sellcount')->orderBy('id')->get();

        $total_icome = Transaction::where('user_id', $user->id)->where('mode', 'deliver')->sum('price');


        $sell_rate_array = $sell_rate->toArray();
        $value = 0;
        $current_rate = [];
        $after_rate = [];
        foreach ($sell_rate_array as $index => $sr) {
            $min = explode(',', $sr['value'])[0];
            $max = explode(',', $sr['value'])[1];
            if ($min < count($userSell) && $max > count($userSell)) {
                $value = $index + 1;
                $current_rate = $sr;
                if (isset($sell_rate_array[$index + 1]))
                    $after_rate = $sell_rate_array[$index + 1];
                else
                    $after_rate = [];
            }
        }

        $sell_count_today = 0;
        $sell_count_month = 0;

        foreach ($userSell as $us) {
            if ($us->created_at > strtotime("midnight") + 12600) {
                $sell_count_today++;
            }
            if ($us->created_at > strtotime("-30 day") + 12600) {
                $sell_count_month++;
            }
        }


        for ($i = 20; $i >= 1; $i--) {
            $timestamp = strtotime('-' . $i . ' day') + 12600;
            $tenDay[$i] = (date('m/d', $timestamp));

            $sellDay[$i] = Sell::where('user_id', $user->id)
                ->where('mode', 'pay')
                ->where('created_at', '>', $timestamp)
                ->where('created_at', '<', $timestamp + 86400)
                ->count();

            $incomeDay[$i] = Transaction::where('user_id', $user->id)
                ->where('mode', 'deliver')
                ->where('created_at', '>', $timestamp)
                ->where('created_at', '<', $timestamp + 86400)
                ->sum('income');
        }

        //dd($tenDay);

        $data = [
            'user' => $user,
            'meta' => $userMetas,
            'buyList' => $userBuy,
            'sell_rate' => $sell_rate,
            'value' => $value,
            'current_rate' => $current_rate,
            'userSellCount' => count($userSell),
            'after_rate' => $after_rate,
            'notifications' => $userNotification,
            'userBuyCount' => $userBuyCount,
            'total_income' => $total_icome,
            'sell_count_today' => $sell_count_today,
            'sell_count_month' => $sell_count_month,
            'captionDay' => $tenDay,
            'sellDay' => $sellDay,
            'incomeDay' => $incomeDay
        ];

        //return view(getTemplate() . '.user.dashboard', $data);
        return redirect('/user/video/buy');
    }

    public function calendar(){
        $user = auth()->user();
        $eventos = CalendarEvents::where('user_id', $user->id)->select(['content as title', 'date', 'product_id as url'])->get();
        $nuevos_eventos = array();
        foreach($eventos as $evento){
            $evento->url = '/product/'.$evento->url;
        }
        $json_eventos = json_encode($nuevos_eventos);
        //$json_eventos = json_encode($nuevos_eventos, JSON_PRETTY_PRINT);
        return view(getTemplate(). '.user.calendar', ['Eventos' => $eventos]);
    }
    public function inscribirse($product_id){
        $user = auth()->user();
        $content = Content::with('metas')->where('mode', 'publish')->find($product_id);        

        $inscrito = CalendarEvents::where('product_id', $product_id)->where('user_id', $user->id)->get();

        if($inscrito->isEmpty()){
            if($content->type == 'coaching' || $content->type == 'webinar'){
                $part_date = ContentPart::where('content_id', $content->id)->first();
                $date = Carbon::createFromFormat('d/m/Y', $part_date->date)->toDateString();
                CalendarEvents::create(['user_id' => $user->id, 'product_id' => $content->id, 
                'date' => $date, 'type' => $content->type, 'content' => 'Horario: '.$part_date->time]);
            }
            return back()->with('msg', trans('¡Inscrito exitosamente!'))->with('type', 'success');
        }else{
            return back()->with('msg', trans('Usted ya se encuentra inscrito.'))->with('type', 'warning');
        }

    }

    public function passwordChange(Request $request)
    {
        $password = $request->get('password');
        $re_password = $request->get('repassword');

        if (!empty($password) and !empty($re_password) and $password == $re_password) {
            $user = auth()->user();
            $new_password = Hash::make($password);
            User::find($user->id)->update([
                'password' => $new_password,
                'first_login' => 'true'
            ]);
            $request->session()->flash('msg', 'success');
            $request->session()->flash('type', 'success');
            return back();
        }

        notify(trans('main.pass_confirmation_same'), 'danger');
        return back();
    }

    public function userProfile()
    {
        $user = auth()->user();
        $userMetas = Usermeta::where('user_id', $user->id)->pluck('value', 'option')->all();
        return view(getTemplate() . '.user.pages.profile', ['user' => $user, 'meta' => $userMetas]);
    }

    public function userProfileStore(Request $request)
    {
        $user = auth()->user();
        User::find($user->id)->update($request->all());
        return back();
    }

    public function userProfileMetaStore(Request $request)
    {
        $data = $request->except('_token');
        $user = auth()->user();

        if (is_array($data) and count($data) > 0) {
            Usermeta::updateOrNew($user->id, $data);

            foreach ($data as $key => $value) {
                cache()->forget('user.' . $user->id . '.meta.' . $key);
            }
            cache()->forget('user.' . $user->id);
            cache()->forget('user.' . $user->id . '.meta');
            cache()->forget('user.' . $user->id . '.metas.pluck.value');
        }
        return back();
    }

    public function userAvatarChange(Request $request)
    {
        $user = auth()->user();
        Usermeta::updateOrNew($user->id, $request->all());
        cache()->forget('user.' . $user->id . '.meta.avatar');
        cache()->forget('user.' . $user->id);
        return back();
    }

    public function userProfileImageChange(Request $request)
    {
        $user = auth()->user();
        Usermeta::updateOrNew($user->id, $request->all());
        return back();
    }

    ## Trip Mode ##
    public function tripModeDeActive()
    {
        $user = auth()->user();
        setUserMeta($user->id, 'trip_mode', '0');
        return back();
    }

    public function tripModeActive(Request $request)
    {
        $user = auth()->user();
        setUserMeta($user->id, 'trip_mode', '1');
        setUserMeta($user->id, 'trip_mode_date', strtotime($request->trip_mode_date) + 12600);
        setUserMeta($user->id, 'trip_mode_date_t', $request->trip_mode_date_t);
        return back();
    }

    #############
    #### Video ####
    #############

    public function userBuyLists()
    {
        $user = auth()->user();
        $buyListQuery = Sell::where('buyer_id', $user->id)->orderBy('id', 'DESC');

        if ($user->vendor == 1) {
            $buyList = $buyListQuery->with(['content' => function ($q) {
                $q->with(['metas', 'category', 'user']);
            }, 'transaction.balance', 'rate' => function ($r) use ($user) {
                $r->where('user_id', $user->id)->first();
            }])->get();

        } else {
            $buyList = $buyListQuery->with(['content' => function ($q) {
                $q->with(['metas', 'category', 'user']);
            }, 'transaction.balance', 'rate' => function ($r) use ($user) {
                $r->where('user_id', $user->id)->first();
            }])->where('type', '<>', 'subscribe')
                ->get();

        }

        return view(getTemplate() . '.user.sell.buy', ['list' => $buyList]);
    }

    public function allCourses(){
        $user = auth()->user();
        $buyListQuery = Sell::where('buyer_id', $user->id)->orderBy('id', 'DESC');

        if ($user->vendor == 1) {
            $buyList = $buyListQuery->with(['content' => function ($q) {
                $q->with(['metas', 'category', 'user']);
            }, 'transaction.balance', 'rate' => function ($r) use ($user) {
                $r->where('user_id', $user->id)->first();
            }])->get();

        } else {
            $buyList = $buyListQuery->with(['content' => function ($q) {
                $q->with(['metas', 'category', 'user']);
            }, 'transaction.balance', 'rate' => function ($r) use ($user) {
                $r->where('user_id', $user->id)->first();
            }])->where('type', '<>', 'subscribe')
                ->get();

        }

        return view(getTemplate() . '.user.dashboard.all', ['list' => $buyList]);
    }

    public function inProcessCourses(){
        $user = auth()->user();
        $buyListQuery = Sell::where('buyer_id', $user->id)->orderBy('id', 'DESC')->get();

        $listadoCursos = array();

        foreach($buyListQuery as $curso){
            $progreso = ProgresoAlumno::where('user_id', $user->id)->where('content_id', $curso->content_id)->get();

            $contar_progreso = $progreso->count();

            $partes = ContentPart::where('content_id', $curso->content_id)->count();

            if(!$progreso->isEmpty() && $contar_progreso != $partes){
                $cursos = Sell::where('buyer_id', $user->id)->where('content_id', $curso->content_id)->orderBy('id', 'DESC');

                $buyList = $cursos->with(['content' => function ($q) {
                    $q->with(['metas', 'category', 'user']);
                }, 'transaction.balance', 'rate' => function ($r) use ($user) {
                    $r->where('user_id', $user->id)->first();
                }])->where('type', '<>', 'subscribe')->get();

                array_push($listadoCursos, $buyList);
            }
        }

        return view(getTemplate() . '.user.dashboard.process', ['list' => $listadoCursos]);
    }

    public function finishedCourses(){
        $user = auth()->user();
        $buyListQuery = Sell::where('buyer_id', $user->id)->orderBy('id', 'DESC')->get();

        $listadoCursos = array();

        foreach($buyListQuery as $curso){
            $progreso = ProgresoAlumno::where('user_id', $user->id)->where('content_id', $curso->content_id)->count();

            $partes = ContentPart::where('content_id', $curso->content_id)->count();

            if($progreso > 0 && $partes > 0 && $progreso == $partes){
                $cursos = Sell::where('buyer_id', $user->id)->where('content_id', $curso->content_id)->orderBy('id', 'DESC');

                $buyList = $cursos->with(['content' => function ($q) {
                    $q->with(['metas', 'category', 'user']);
                }, 'transaction.balance', 'rate' => function ($r) use ($user) {
                    $r->where('user_id', $user->id)->first();
                }])->where('type', '<>', 'subscribe')->get();

                array_push($listadoCursos, $buyList);
            }
        }

        return view(getTemplate() . '.user.dashboard.finished', ['list' => $listadoCursos]);
    }

    public function userBuyPrint($id)
    {
        $user = auth()->user();
        $buyQuery = Sell::where('id', $id)->where('buyer_id', $user->id);

        $buy = $buyQuery->with(['content' => function ($q) {
            $q->with(['metas', 'category', 'user']);
        }, 'transaction.balance'])
            ->first();

        return view(getTemplate() . '.user.sell.print', ['title' => trans('main.print_invoice'), 'item' => $buy]);
    }

    public function userBuyConfirm(Request $request, $id)
    {
        $user = auth()->user();
        $sell = Sell::where('id', $id)->where('buyer_id', $user->id)->first();
        if (!$sell) {
            return abort(404);
        }

        if ($sell->post_confrim != '') {
            return redirect()->back()->with('msg', trans('main.parcel_confirm'));
        }

        $sell->update([
            'post_confirm' => $request->post_confirm,
            'post_feedback' => $request->post_feedback
        ]);

        return redirect()->back()->with('msg', trans('main.parcel'));
    }

    public function userBuyRateStore($id, $rate)
    {
        $user = auth()->user();
        $ifHasSell = Sell::where('buyer_id', $user->id)->find($id);
        if ($ifHasSell) {
            $sellRate = SellRate::firstOrNew(['user_id' => $user->id, 'sell_id' => $id]);
            $sellRate->rate = $rate;
            $sellRate->seller_id = $ifHasSell->user_id;
            $sellRate->save();
            return 1;
        }
        return 0;
    }

    ## Subscribe ##
    public function subscribeList(Request $request)
    {
        $user = auth()->user();
        $buyList = Sell::with(['content' => function ($q) {
            $q->with(['metas', 'category', 'user']);
        }, 'transaction.balance', 'rate' => function ($r) use ($user) {
            $r->where('user_id', $user->id)->first();
        }])->where('buyer_id', $user->id)->where('type', 'subscribe')->orderBy('id', 'DESC')->get();
        return view(getTemplate() . '.user.sell.subscribe', ['list' => $buyList]);
    }


    ## Off Section ##
    public function userDiscounts()
    {
        $user = auth()->user();
        $userContent = Content::where('user_id', $user->id)->where('mode', 'publish')->get();
        $userContentIds = $userContent->pluck('id')->toArray();
        $discounts = DiscountContent::with('content')->whereIn('off_id', $userContentIds)->where('type', 'content')->get();
        return view(getTemplate() . '.user.sell.off', ['userContent' => $userContent, 'discounts' => $discounts]);
    }

    public function userDiscountEdit($id)
    {
        $user = auth()->user();
        $userContent = Content::where('user_id', $user->id)->where('mode', 'publish')->get();
        $userContentIds = $userContent->pluck('id')->toArray();
        $discounts = DiscountContent::with('content')->whereIn('off_id', $userContentIds)->where('type', 'content')->get();
        $discount = DiscountContent::with('content.user')->find($id);
        if ($discount->content->user->id == $user->id) {
            return view(getTemplate() . '.user.sell.off', ['userContent' => $userContent, 'discounts' => $discounts, 'discount' => $discount]);
        } else {
            return abort(404);
        }
    }

    public function userDiscountStore(Request $request)
    {
        $user = auth()->user();
        $check_user_has_content = Content::where('user_id', $user->id)->where('id', $request->off_id)->count();

        if ($check_user_has_content == 1) {
            $fist_date = strtotime($request->first_date) + 12600;
            $last_date = strtotime($request->last_date) + 12600;
            $array = [
                'first_date' => $fist_date,
                'last_date' => $last_date,
                'off_id' => $request->off_id,
                'off' => $request->off,
                'mode' => 'draft',
                'type' => 'content',
                'created_at' => time()
            ];
            DiscountContent::create($array);
            return redirect()->back()->with('msg', trans('main.discount_add_success'));
        }
    }

    public function userDiscountEditStore($id, Request $request)
    {
        $user = auth()->user();
        $check_user_has_content = Content::where('user_id', $user->id)->where('id', $request->off_id)->count();

        if ($check_user_has_content == 1) {
            $fist_date = strtotime($request->first_date) + 12600;
            $last_date = strtotime($request->last_date) + 12600;
            $array = [
                'first_date' => $fist_date,
                'last_date' => $last_date,
                'off_id' => $request->off_id,
                'off' => $request->off,
                'mode' => 'draft',
                'type' => 'content',
                'created_at' => time()
            ];
            DiscountContent::find($id)->update($array);
            return redirect()->back()->with('msg', trans('main.discount_edit'));
        }
    }

    public function userDiscountDelete($id)
    {
        $user = auth()->user();
        $discount = DiscountContent::with('content.user')->find($id);
        if ($discount->content->user->id == $user->id) {
            DiscountContent::find($id)->delete();
            return redirect()->back()->with('msg', trans('main.discount_delete'));
        } else {
            return redirect()->back()->with('msg', trans('main.discount_delete_unable'));
        }
    }

    ## Promotion Section ##
    public function promotions()
    {
        $user = auth()->user();
        $plans = AdsPlan::where('mode', 'publish')->orderBy('id', 'DESC')->get();
        $list = AdsRequest::with(['plan', 'content'])->where('user_id', $user->id)->orderBy('id', 'DESC')->get();
        return view(getTemplate() . '.user.promotion.promotion', ['plans' => $plans, 'list' => $list]);
    }

    public function promotionBuy($id)
    {
        $user = auth()->user();
        $plan = AdsPlan::find($id);
        $plans = AdsPlan::where('mode', 'publish')->orderBy('id', 'DESC')->get();
        $userContent = Content::where('user_id', $user->id)->where('mode', 'publish')->get();
        return view(getTemplate() . '.user.promotion.promotionBuy', ['plan' => $plan, 'userContent' => $userContent, 'plans' => $plans]);
    }

    public function promotionPay(Request $request)
    {
        $user = auth()->user();
        $plan = AdsPlan::find($request->plan_id);
        $Amount = $plan->price;
        $Description = $request->description;

        if ($request->gateway == 'paypal') {
            $payer = new Payer();
            $payer->setPaymentMethod('paypal');
            $item_1 = new Item();
            $item_1->setName($plan->title)
                ->setCurrency(currency())
                ->setQuantity(1)
                ->setPrice($Amount);
            $item_list = new ItemList();
            $item_list->setItems(array($item_1));
            $amount = new Amount();
            $amount->setCurrency(currency())
                ->setTotal($Amount);
            $transaction = new \PayPal\Api\Transaction();
            $transaction->setAmount($amount)
                ->setItemList($item_list)
                ->setDescription('Purchase Promotion');
            $redirect_urls = new RedirectUrls();
            $redirect_urls->setReturnUrl(url('/') . '/user/video/promotion/buy/pay/verify')
                ->setCancelUrl(url('/') . '/user/video/promotion/buy/cancel');
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
            $requestA = [
                'user_id' => $user->id,
                'content_id' => $request->content_id,
                'plan_id' => $plan->id,
                'description' => $request->description,
                'mode' => 'pending',
                'transaction' => $ids,
                'created_at' => time()
            ];
            AdsRequest::create($requestA);
            /** add payment ID to session **/
            if (isset($redirect_url)) {
                /** redirect to paypal **/
                return Redirect::away($redirect_url);
            }
            \Session::put('error', 'Unknown error occurred');
            return Redirect::route('paywithpaypal');
        }
        if ($request->gateway == 'paytm') {
            $payment = PaytmWallet::with('receive');
            $requestA = [
                'user_id' => $user->id,
                'content_id' => $request->content_id,
                'plan_id' => $plan->id,
                'description' => $request->description,
                'mode' => 'pending',
                'transaction' => '0',
                'created_at' => time()
            ];
            $Transaction = AdsRequest::create($requestA);
            $payment->prepare([
                'order' => $Transaction->id,
                'user' => $user->id,
                'email' => $user->email,
                'mobile_number' => '00187654321',
                'amount' => $Amount,
                'callback_url' => url('/') . '/user/video/promotion/buy/pay/verify?gateway=paytm'
            ]);
            return $payment->receive();
        }
        if ($request->gateway == 'paystack') {
            $payStack = new \Unicodeveloper\Paystack\Paystack();
            $requestA = [
                'user_id' => $user->id,
                'content_id' => $request->content_id,
                'plan_id' => $plan->id,
                'description' => $request->description,
                'mode' => 'pending',
                'transaction' => '0',
                'created_at' => time()
            ];
            $Transaction = AdsRequest::create($requestA);
            $payStack->getAuthorizationResponse([
                "amount" => $Amount,
                "reference" => Paystack::genTranxRef(),
                "email" => $user->email,
                "callback_url" => url('/') . '/user/video/promotion/buy/pay/verify?gateway=paystack',
                'metadata' => json_encode(['transaction' => $Transaction->id])
            ]);
            return redirect($payStack->url);
        }
    }

    public function promotionVerify(Request $request)
    {
        $user = auth()->user();
        if (!isset($request->gateway)) {
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
            $request = AdsRequest::with('plan')->where('transaction', $payment_id)->where('user_id', $user->id)->first();
            $Amount = $request->plan->price;

            if ($result->getState() == 'approved') {

                $request->update(['mode' => 'pay']);

                Balance::create([
                    'title' => trans('main.product_promotion'),
                    'description' => trans('main.promoted'),
                    'type' => 'add',
                    'price' => $Amount,
                    'mode' => 'auto',
                    'user_id' => $user->id,
                    'exporter_id' => 0,
                    'created_at' => time()
                ]);

                return redirect('/user/video/promotion')->with('msg', trans('main.promotion_success_approval'));
            }
        }
        if (isset($request->gateway) && $request->gateway == 'paytm') {
            $transaction = PaytmWallet::with('receive');
            $Order = AdsRequest::with('plan')->find($transaction->getOrderId());
            $Amount = $Order->plan->price;
            if ($transaction->isSuccessful()) {
                $Order->update(['mode' => 'pay']);
                Balance::create([
                    'title' => trans('main.product_promotion'),
                    'description' => trans('main.promoted'),
                    'type' => 'add',
                    'price' => $Amount,
                    'mode' => 'auto',
                    'user_id' => $user->id,
                    'exporter_id' => 0,
                    'created_at' => time()
                ]);
                return redirect('/user/video/promotion')->with('msg', trans('main.promotion_success_approval'));
            }
        }
        if (isset($request->gateway) && $request->gateway == 'paystack') {
            $payment = Paystack::getPaymentData();
            if (isset($payment['status']) && $payment['status'] == true) {
                $Order = AdsRequest::with('plan')->find($payment['data']['metadata']['transaction']);
                $Amount = $Order->plan->price;
                $Order->update(['mode' => 'pay']);
                Balance::create([
                    'title' => trans('main.product_promotion'),
                    'description' => trans('main.promoted'),
                    'type' => 'add',
                    'price' => $Amount,
                    'mode' => 'auto',
                    'user_id' => $user->id,
                    'exporter_id' => 0,
                    'created_at' => time()
                ]);
                return redirect('/user/video/promotion')->with('msg', trans('main.promotion_success_approval'));
            }
        }

        return redirect('/user/video/promotion')->with('msg', trans('main.promotion_failed_later'));
    }

    ## records Section ##

    public function records()
    {
        $user = auth()->user();
        $lists = Record::where('user_id', $user->id)->with('category')->withCount('fans')->orderBy('id', 'DESC')->get();
        $userContent = Content::where('user_id', $user->id)->where('mode', 'publish')->get();
        $contentMenu = ContentCategory::with(['childs', 'filters' => function ($q) {
            $q->with(['tags']);
        }])->get();
        return view(getTemplate() . '.user.record.record', ['lists' => $lists, 'menus' => $contentMenu, 'userContent' => $userContent]);
    }

    public function recordEdit($id)
    {
        $user = auth()->user();
        $lists = Record::where('user_id', $user->id)->with('category')->withCount('fans')->orderBy('id', 'DESC')->get();
        $userContent = Content::where('user_id', $user->id)->where('mode', 'publish')->get();
        $record = Record::where('user_id', $user->id)->find($id);
        $contentMenu = ContentCategory::with(['childs', 'filters' => function ($q) {
            $q->with(['tags']);
        }])->get();
        if (!$record)
            abort(404);
        return view(getTemplate() . '.user.record.record', ['lists' => $lists, 'menus' => $contentMenu, 'userContent' => $userContent, 'record' => $record]);
    }

    public function recordDelete($id)
    {
        $user = auth()->user();
        $record = Record::where('user_id', $user->id)->find($id);
        $record->update(['mode' => 'delete']);
        return redirect()->back()->with('msg', trans('main.unpublish_request_sent'));
    }

    public function recordStore(Request $request)
    {
        $user = auth()->user();
        Record::create([
            'user_id' => $user->id,
            'category_id' => $request->category_id,
            'content_id' => $request->content_id,
            'title' => $request->title,
            'image' => $request->image,
            'description' => $request->description,
            'mode' => 'draft',
            'created_at' => time()
        ]);
        return redirect()->back()->with('msg', trans('main.content_approval'));
    }

    public function recordUpdate($id, Request $request)
    {
        $user = auth()->user();
        $record = Record::where('user_id', $user->id)->find($id);
        $record->update([
            'user_id' => $user->id,
            'category_id' => $request->category_id,
            'content_id' => $request->content_id,
            'title' => $request->title,
            'image' => $request->image,
            'description' => $request->description,
            'mode' => 'draft',
        ]);
        return redirect()->back()->with('msg', trans('main.content_edit'));
    }

    ## request Section ##
    public function requests()
    {
        $user = auth()->user();
        $lists = Requests::where('user_id', $user->id)->orWhere('requester_id', $user->id)->with(['category', 'requester', 'suggestions' => function ($q) {
            $q->with(['content', 'user']);
        }])->withCount(['fans', 'suggestions'])->orderBy('id', 'DESC')->get();
        $userContent = Content::where('user_id', $user->id)->where('mode', 'publish')->get();


        $data = [
            'lists' => $lists,
            'menus' => contentMenu(),
            'userContent' => $userContent
        ];

        return view(getTemplate() . '.user.request.request', $data);
    }

    public function requestStore(Request $request)
    {
        $user = auth()->user();
        Requests::create([
            'user_id' => 0,
            'requester_id' => $user->id,
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'mode' => 'draft',
            'created_at' => time()
        ]);
        return redirect()->back()->with('msg', trans('main.request_sent'));
    }

    public function requestEdit($id)
    {
        $user = auth()->user();
        $lists = Requests::where('user_id', $user->id)->orWhere('requester_id', $user->id)->with(['category', 'requester', 'suggestions' => function ($q) {
            $q->with(['content', 'user']);
        }])->withCount(['fans', 'suggestions'])->orderBy('id', 'DESC')->get();
        $userContent = Content::where('user_id', $user->id)->where('mode', 'publish')->get();
        $request = Requests::where('requester_id', $user->id)->find($id);
        if (!$request)
            abort(404);
        return view(getTemplate() . '.user.request.request', ['lists' => $lists, 'menus' => contentMenu(), 'userContent' => $userContent, 'request' => $request]);
    }

    public function requestUpdate($id, Request $request)
    {
        $user = auth()->user();
        $req = Requests::where('requester_id', $user->id)->find($id);
        if (!$req)
            return abort(404);
        $req->update([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'mode' => 'draft',
        ]);
        return redirect()->back()->with('msg', trans('main.request_edit'));
    }

    public function requestAdmit(Request $request)
    {
        $user = auth()->user();
        $id = $request->get('request_id', null);

        if (!empty($id)) {
            $uRequest = Requests::where('id', $id)->where('requester_id', $user->id)->first();;
            if ($uRequest) {
                $uRequest->update(['content_id' => $request->content_id]);
            }
        }

        return redirect()->back();
    }

    public function requestDelete($id)
    {
        $user = auth()->user();
        $req = Requests::where('id', $id)->where('requester_id', $user->id)->first();
        if (!empty($req)) {
            $req->delete();
        }
        return redirect()->back();
    }


    ## Articles Section ##
    public function articles()
    {
        $user = auth()->user();
        $lists = Article::with(['category'])->where('user_id', $user['id'])->orderBy('id', 'DESC')->get();
        return view(getTemplate() . '.user.article.list', ['lists' => $lists]);
    }

    public function articleNew()
    {
        return view(getTemplate() . '.user.article.new');
    }

    public function articleStore(Request $request)
    {
        $user = auth()->user();
        $request->request->add(['user_id' => $user['id'], 'created_at' => time()]);
        $article = Article::create($request->toArray());
        return redirect('/user/article/edit/' . $article->id)->with('msg', trans('main.article_success'));
    }

    public function articleEdit($id)
    {
        $user = auth()->user();
        $article = Article::where('user_id', $user['id'])->find($id);
        if (!$article)
            return abort(404);
        return view(getTemplate() . '.user.article.edit', ['article' => $article]);
    }

    public function articleUpdate(Request $request, $id)
    {
        $user = auth()->user();
        $article = Article::where('user_id', $user['id'])->find($id);
        if (!$article)
            return abort(404);
        $article->update($request->toArray());
        return redirect('/user/article/edit/' . $id);
    }

    public function articleDelete($id)
    {
        $user = auth()->user();
        $article = Article::where('user_id', $user['id'])->find($id);
        $article->update(['mode' => 'delete']);
        return back();
    }


    #################
    #### Channel ####
    #################

    public function channelList()
    {
        $user = auth()->user();
        $channels = Channel::withCount('contents')->where('user_id', $user->id)->get();
        return view(getTemplate() . '.user.channel.list', ['channels' => $channels]);
    }

    public function channelNew()
    {
        return view(getTemplate() . '.user.channel.new');
    }

    public function channelStore(Request $request)
    {
        $user = auth()->user();
        $ifChannelExist = Channel::where('username', $request->username)->first();
        if (!empty($ifChannelExist)) {
            $request->request->add(['mode' => 'pending']);
            $request->session()->flash('Message', 'duplicate_username');
            return back();
        } else {
            $request->request->add(['user_id' => $user->id, 'mode' => get_option('user_channel_mode')]);
            Channel::create($request->all());
            $request->session()->flash('Message', 'successfull');
            return back();
        }
    }

    public function channelDelete($id)
    {
        $user = auth()->user();
        Channel::where('id', $id)->where('user_id', $user->id)->delete();
        return redirect('/user/channel');
    }

    public function channelEdit($id)
    {
        $user = auth()->user();
        $item = Channel::where('id', $id)->where('user_id', $user->id)->first();
        $channels = Channel::where('user_id', $user->id)->get();
        if ($item)
            return view(getTemplate() . '.user.channel.edit', ['edit' => $item, 'channels' => $channels]);
        else
            return back();
    }

    public function channelUpdate($id, Request $request)
    {
        $user = auth()->user();
        $request->request->add(['mode' => 'pending']);
        $data = $request->except(['_token']);
        Channel::find($id)->where('user_id', $user->id)->update($data);
        $request->session()->flash('Message', 'successfull');
        return back();
    }

    public function channelRequest($id)
    {
        $user = auth()->user();
        $channelsRequest = ChannelRequest::with('channel')->where('user_id', $user->id)->orderBy('id', 'DESC')->get();
        $channels = Channel::withCount('contents')->where('user_id', $user->id)->get();
        return view(getTemplate() . '.user.channel.request', ['id' => $id, 'requests' => $channelsRequest, 'channels' => $channels]);
    }

    public function channelRequestStore(Request $request)
    {
        $user = auth()->user();
        $check = Channel::where('user_id', $user->id)->find($request->channel_id);
        if (!$check)
            return back();

        ChannelRequest::create([
            'title' => $request->title,
            'channel_id' => $request->channel_id,
            'user_id' => $user->id,
            'mode' => 'draft',
            'attach' => $request->attach,
            'created_at' => time()
        ]);
        return redirect()->back()->with('msg', trans('main.channel_success'));
    }

    public function chanelVideo($id)
    {
        $user = auth()->user();
        $chanel = Channel::with('contents.content')->where('user_id', $user->id)->find($id);
        if (!$chanel)
            return abort(404);

        $userContents = Content::where('mode', 'publish')->where('user_id', $user->id)->get();
        return view(getTemplate() . '.user.channel.video', ['chanel' => $chanel, 'userContents' => $userContents]);
    }

    public function chanelVideoStore(Request $request, $id)
    {
        $user = auth()->user();
        $chanel = Channel::where('user_id', $user->id)->find($id);
        if (!$chanel)
            return abort(404);

        ChannelVideo::create([
            'content_id' => $request->content_id,
            'user_id' => $user->id,
            'chanel_id' => $chanel->id,
            'created_at' => time()
        ]);

        return redirect()->back()->with('msg', trans('main.add_success'));
    }

    public function chanelVideoDelete($id)
    {
        $user = auth()->user();
        ChannelVideo::where('user_id', $user->id)->find($id)->delete();
        return redirect()->back();
    }

    #################
    #### Content ####
    #################

    public function contentList()
    {
        $user = auth()->user();
        $lists = Content::where('user_id', $user->id)->with('category')->withCount('sells', 'partsactive')->orderBy('id', 'DESC')->get();
        return view(getTemplate() . '.user.content.list', ['lists' => $lists]);
    }

    public function contentDelete($id)
    {
        $user = auth()->user();
        Content::where('id', $id)->where('user_id', $user->id)->update(['mode' => 'delete']);
        contentCacheForget();
        return back();
    }

    public function contentRequest($id)
    {
        $user = auth()->user();
        $content = Content::where('user_id', $user->id)->find($id);

        ## Notification Center
        sendNotification(0, ['[u.name]' => $user->name, '[c.title]' => $content->title], get_option('notification_template_content_pre_publish'), 'user', $user->id);

        $content->update(['mode' => 'request']);
        contentCacheForget();
        return back();
    }

    public function contentDraft($id)
    {
        $user = auth()->user();
        Content::where('id', $id)->where('user_id', $user->id)->update(['mode' => 'draft']);
        contentCacheForget();
        return back();
    }

    public function contentNew()
    {
        return view(getTemplate() . '.user.content.selectnew');
    }

    public function contentNewCourse(){
        $contentMenu = ContentCategory::with(['childs', 'filters' => function ($q) {
            $q->with(['tags']);
        }])->get();
        return view(getTemplate() . '.user.content.new', ['menus' => $contentMenu]);
    }
    public function contentNewWebinar(){
        $contentMenu = ContentCategory::with(['childs', 'filters' => function ($q) {
            $q->with(['tags']);
        }])->get();
        return view(getTemplate() . '.user.content.new_webinar', ['menus' => $contentMenu]);
    }
    public function contentNewCoaching(){
        $contentMenu = ContentCategory::with(['childs', 'filters' => function ($q) {
            $q->with(['tags']);
        }])->get();
        return view(getTemplate() . '.user.content.new_coaching', ['menus' => $contentMenu]);
    }

    public function contentStore(Request $request)
    {
        $user = auth()->user();
        $newContent = $request->except(['_token', 'guia_trabajo']);
        $newContent['created_at'] = time();
        $newContent['mode'] = 'draft';
        $newContent['user_id'] = $user->id;
        
        if($newContent['private'] == 2 ){
            $newContent['content_type'] = 'Fundal';
        }elseif($newContent['private'] == 3){
            $newContent['content_type'] = 'Videoteca';
        }

        $newChat = ['name' => $newContent['title'], 'creator' => $user->id, 'published' => 'false'];
        $chat_id = Chat_Chats::insertGetId($newChat);

        $insert_intoChat = ['chat_id' => $chat_id, 'user_id' => $user->id];
        Chat_UsersInChat::insert($insert_intoChat);

        $newContent['chat_id'] = $chat_id;
        $content_id = Content::insertGetId($newContent);

        $guia = $request->guia_trabajo;


            if(isset($guia)){
                if($guia->isValid()){
                    $guia->move('bin/contenido-cursos/'.$content_id.'/guia/', 'Guía-'.$newContent['title'].'.'.$guia->getClientOriginalExtension());
                }
            }

        $forum_category = ForumCategory::create(['product_id' => $content_id, 'title' => $newContent['title'], 'desc' => 'Un foro para el curso '.$newContent['title'], 'published' => 'true', 'type' => $newContent['private'] == 2 ? 'private' : 'public']);

        if($newContent['type'] == 'webinar' || $newContent['type'] == 'coaching'){
            return redirect('/user/content/web_coach/edit/'.$content_id);
        }else{
            return redirect('/user/content/edit/'.$content_id);
        }

    }

    public function contentEdit($id)
    {
        $user = auth()->user();
        $item = Content::with('parts', 'filters')->where('id', $id)->where('user_id', $user->id)->first();
        $meta = arrayToList($item->metas, 'option', 'value');
        if (isset($meta['precourse']) && $meta['precourse'] != '') {
            $preCourseContent = Content::where('mode', 'publish')->whereIn('id', explode(',', rtrim($meta['precourse'], ',')))->get();
        } else {
            $preCourseContent = [];
        }
        $contentMenu = ContentCategory::with(['childs', 'filters' => function ($q) {
            $q->with(['tags']);
        }])->get();
        if($item['type'] == 'webinar' || $item['type'] == 'coaching'){
            return view(getTemplate() . '.user.content.editweb_coach',['item'=>$item,'meta'=>$meta,'menus'=>$contentMenu,'preCourse'=>$preCourseContent]);
        }else{
            return view(getTemplate() . '.user.content.edit', ['item' => $item, 'meta' => $meta, 'menus' => $contentMenu, 'preCourse' => $preCourseContent]);
        }
    }

    public function contentEditWeb_Coach($id){
        $user = auth()->user();
        $item = Content::with('parts','filters')->where('id',$id)->where('user_id',$user->id)->first();
        $meta = arrayToList($item->metas,'option','value');
        if(isset($meta['precourse']) && $meta['precourse'] != '') {
            $preCourseContent = Content::where('mode', 'publish')->whereIn('id', explode(',',rtrim($meta['precourse'], ',')))->get();
        }else{
            $preCourseContent = [];
        }
        $contentMenu = ContentCategory::with(['childs','filters'=>function($q){
            $q->with(['tags']);
        }])->get();
        return view(getTemplate() . '.user.content.editweb_coach',['item'=>$item,'meta'=>$meta,'menus'=>$contentMenu,'preCourse'=>$preCourseContent]);
    }

    public function contentUpdate($id, Request $request)
    {
        $user = auth()->user();
        $request->request->add(['mode' => 'draft']);
        $content = Content::where('user_id', $user->id)->find($id);
        //$chat_id = Content::where('id', $id)->first()->chat_id;
        if ($content) {
            $request = $request->all();
            print_r($request);
            if (isset($request['filters']) && count($request['filters']) > 0) {
                $content->filters()->sync($request['filters']);
            }
            unset($request['filters']);
            Chat_Chats::where('id', '4')->update(['name' => $content->title]);
            $content->update($request);
            echo 'true';
        } else {
            echo 'false';
        }

    }

    public function contentUpdateRequest($id, Request $request)
    {   
        $user = auth()->user();
        $request->request->add(['mode' => 'request']);
        $content = Content::where('user_id', $user->id)->find($id);

        if ($content) {
            $request = $request->except('_token');
            print_r($request);
            if (isset($request['filters']) && count($request['filters']) > 0) {
                $content->filters()->sync($request['filters']);
            }
            unset($request['filters']);
            $content->update($request);
            contentCacheForget();
            echo 'true';
        } else {
            echo 'false';
        }

    }

    public function contentMetaStore($id, Request $request)
    {
        $user = auth()->user();
        $content = Content::where('user_id', $user->id)->find($id);
        if ($content) {
            ContentMeta::updateOrNew($content->id, $request->all());
            echo 'true';
        }
    }

    ## Part Section ##

    public function contentPartList($id)
    {
        $user = auth()->user();

        $content = Content::where('id', $id)
            ->where('user_id', $user->id)
            ->with(['parts' => function ($q) {
                $q->orderBy('sort');
            }])->first();

        if (!empty($content)) {
            $data = [
                'lists' => $content->parts,
                'id' => $id
            ];

            return view(getTemplate() . '.user.content.part.list', $data);
        }

        abort(404);
    }

    public function contentPartNew($id)
    {
        return view(getTemplate() . '.user.content.part.new', ['id' => $id]);
    }

    public function contentPartEdit($id)
    {
        $user = auth()->user();
        $contentPart = ContentPart::with('content')->find($id);
        if ($contentPart && $contentPart->content->user_id = $user->id) {
            return $contentPart;
            return view(getTemplate() . '.user.content.part.edit', ['part' => $contentPart]);
        } else {
            return 0;
        }
    }

    public function contentPartDelete($id)
    {
        $user = auth()->user();
        $part = ContentPart::with('content')->find($id);
        if ($part->content->user_id == $user->id) {
            $part->update(['mode' => 'delete']);
        }
        return back();
    }

    public function contentPartDraft($id)
    {
        $user = auth()->user();
        $part = ContentPart::with('content')->find($id);
        if ($part->content->user_id == $user->id) {
            $part->update(['mode' => 'draft']);
        }
        return back();
    }

    public function contentPartRequest($id)
    {
        $user = auth()->user();
        $part = ContentPart::with('content')->find($id);
        if ($part->content->user_id == $user->id) {
            $part->update(['mode' => 'request']);
        }
        return back();
    }

    public function contentPartStore(Request $request)
    {  
        $user = auth()->user();
        $content = Content::where('user_id', $user->id)->find($request->content_id);
        if ($content) {
            $request->request->add(['created_at' => time(), 'mode' => 'publish']);
            $newPart = ContentPart::create($request->except('material'));

            $material = $request->material;

            if(isset($material)){
                if($material->isValid()){
                    $material->move('bin/contenido-cursos/'.$content->id.'/'.$newPart->id.'/', $material->getClientOriginalName());
                }
            }
            return back();
            //return redirect('/user/content/part/list/' . $content->id);
        } else {
            echo 'error';
        }

    }

    public function contentPartStoreWeb_Coach(Request $request)
    {   
        $user = auth()->user();
        $content = Content::where('user_id',$user->id)->find($request->content_id);
        if($content){
            $request->request->add(['create_at'=>time(),'mode'=>'publish']);
            $create = $request->create_at;
            $request->request->remove('create_at');
            $request->request->add(['created_at'=>$create]);
            //Zoom api
            $date = $request->date;
            $time = $request->time;
            $duration = $request->duration;
            $title = $request->title;
            $usuario = $request->mail;
            
            $Complete_Time = $date.'T'.$time.'Z';
            $params = [
                'duration' => $duration,
                'start_time' => $Complete_Time,
                'topic' => $title,
                'type' => '2'
            ];

            $api_uri = 'https://api.zoom.us/v2/users/'.$usuario.'/meetings';
            $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJhdWQiOm51bGwsImlzcyI6ImxMLTFOOXprVGpPQlFaQU1GNWZzVEEiLCJleHAiOjE2NDA5MzA0MDAsImlhdCI6MTYxMDk5NTQ5N30.-VywSOV5r8DqaKH0SUsWHGK-TKwVjLygasbUYcbVgOI';
            $client = new Client(['verify' => '../cacert.pem']);
            $res = $client->request('POST', $api_uri, [
                'headers' => [
                    'Authorization' => 'Bearer '.$token,
                    'Accept' => 'application/json',
                ],
                'json' => $params
            ]);

            $data = json_decode($res->getBody(), true);
            //var_dump($data);
            $meeting = $data['id'];

            $request->request->add(['zoom_meeting'=>$meeting]);
            $newPart = ContentPart::create($request->all());
            echo $newPart->id;
            return back();
        }else{
            //$date = $request->request->date;
            //$time = $request->request->time;
            //$duration = $request->request->duration;
            //$title = $request->request->title;
            //$Complete_Time = $date.'T'.$time.'Z';
            echo 'error';
        }

    }

    public function contentPartUpdate(Request $request, $id)
    {
        $user = auth()->user();
        $content = Content::where('user_id', $user->id)->find($request->content_id);
        if ($content) {
            $request->request->add(['mode' => 'request']);
            ContentPart::find($id)->update($request->all());
            return back();
        } else {
            return back();
        }

    }

    public function contentPartEditStoreWeb_Coach(Request $request,$id)
    {
        $user = auth()->user();
        $content = Content::where('user_id',$user->id)->find($request->content_id);
        if($content){
            $request->request->add(['mode'=>'request']);
            $create = $content->created_at;
            $request->request->remove('create_at');
            $request->request->add(['created_at'=>$create]);
            //Zoom api
            $date = $request->date;
            $time = $request->time;
            $duration = $request->duration;
            $title = $request->title;
            $usuario = $request->mail;
            
            $Complete_Time = $date.'T'.$time.'Z';
            $params = [
                'duration' => $duration,
                'start_time' => $Complete_Time,
                'topic' => $title,
                'type' => '2'
            ];
            $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJhdWQiOm51bGwsImlzcyI6ImxMLTFOOXprVGpPQlFaQU1GNWZzVEEiLCJleHAiOjE2NDA5MzA0MDAsImlhdCI6MTYxMDk5NTQ5N30.-VywSOV5r8DqaKH0SUsWHGK-TKwVjLygasbUYcbVgOI';
            $client = new Client(['verify' => '../cacert.pem']);
            $res = $client->request('POST', 'https://api.zoom.us/v2/users/'.$usuario.'/meetings', [
                'headers' => [
                    'Authorization' => 'Bearer '.$token,
                    'Accept' => 'application/json',
                ],
                'json' => $params
            ]);

            $data = \json_decode($res->getBody(), true);
            //var_dump($data);
            $meeting = $data['id'];

            $request->request->add(['zoom_meeting'=>$meeting]);
            //var_dump($request);
            ContentPart::find($id)->update($request->all());
            return back();
        }else{
            return back();
        }

    }

    ## Json Section
    public function contentPartsJson($id)
    {
        $user = auth()->user();
        $result = [];
        $content = Content::with(['parts' => function ($q) {
            $q->orderBy('sort');
        }])->where('user_id', $user->id)->find($id);
        foreach ($content->parts as $index => $part) {
            $result[$index] = $part;
            $result[$index]['created_at'] = date('d F Y H:i', $part['created_at']);
            switch ($part['mode']) {
                case 'request':
                    $result[$index]['mode'] = '<b style="color:orange">Waiting</b>';
                    break;
                case 'delete':
                    $result[$index]['mode'] = '<b style="color:red;">Delete</b>';
                    break;
                case 'draft':
                    $result[$index]['mode'] = '<b style="color:goldenrod;">Save</b>';
                    break;
                case 'publish':
                    $result[$index]['mode'] = '<b style="color:green;">Publish</b>';
                    break;
            }
            switch ($part['free']) {
                case '1':
                    $result[$index]['price'] = '<img src="/assets/images/svg/ulck.svg" style="width: 20px;height: auto;" title="Paid">';
                    $result[$index]['title'] .= '&nbsp;(Free)&nbsp;';
                    break;
                case '0':
                    $result[$index]['price'] = '<img src="/assets/images/svg/lck.svg" style="width: 20px;height: auto;" title="Free">';;
                    break;
                case '':
                    $result[$index]['price'] = '<img src="/assets/images/svg/ulck.svg" style="width: 20px;height: auto;" title="Paid">';
                    break;
            }
        }
        return $result;
    }

    ## Content Meeting ##
    public function contentMeetingItem($id)
    {
        $user = auth()->user();
        $dates = MeetingDate::where('user_id', $user->id)->where('content_id', $id)->get();
        $meetings = MeetingLink::where('user_id', $user->id)->where('content_id', $id)->get();
        $Content = Content::where('user_id', $user->id)->find($id);
        return view('web.default.user.content.meeting.list', [
            'dates' => $dates,
            'meetings' => $meetings,
            'id' => $id,
            'content' => $Content
        ]);
    }

    public function contentMeetingAction(Request $request)
    {
        $user = auth()->user();
        if ($request->action == 'zoom') {
            $Content = Content::where('user_id', $user->id)->find($request->content_id);
            if (!$Content)
                return ['status' => -1];

            $Zoom = zoomCreateMeeting($user->id, $Content->id, $Content->title, 60);
            return $Zoom;
        }
        if ($request->action == 'inactive') {
            $Content = Content::where('user_id', $user->id)->find($request->id);
            if (!$Content)
                return back()->with('msg', trans('admin.content_not_found'));

            $Content->update(['meeting_mode' => 'inactive']);
            return back()->with('msg', trans('main.successful'));
        }
        if ($request->action == 'active') {
            $Content = Content::where('user_id', $user->id)->find($request->id);
            if (!$Content)
                return back()->with('msg', trans('admin.content_not_found'));

            $Content->update([
                'meeting_type'      => $request->type,
                'meeting_join_url'  => $request->join_link,
                'meeting_start_url' => $request->start_link,
                'meeting_mode'      => 'active',
                'meeting_password'  => $request->meeting_password
            ]);

            return back()->with('msg', trans('main.successful'));
        }
    }

    public function contentMeetingNewStore($id, Request $request)
    {
        $user = auth()->user();
        $Content = Content::where('user_id', $user->id)->find($id);
        if (!$Content)
            return back()->with('msg', trans('main.access_denied_content'));

        $request->request->add(['content_id' => $id, 'user_id' => $user->id]);
        MeetingDate::create($request->all());

        return back();
    }

    public function contentMeetingDelete($id)
    {
        $user = auth()->user();
        MeetingDate::where('user_id', $user->id)->find($id)->delete();
        return back();
    }

    #################
    #### Tickets ####
    #################
    public function tickets()
    {
        $user = auth()->user();
        $ticket_invite = TicketsUser::where('user_id', $user->id)->pluck('ticket_id');
        $tickets = Tickets::with('category', 'messages')->orderBy('id', 'DESC')->where('user_id', $user->id)->orWhereIn('id', $ticket_invite->toArray())->get();
        $category = TicketsCategory::get();
        return view(getTemplate() . '.user.ticket.list', ['lists' => $tickets, 'category' => $category]);
    }

    public function ticketStore(Request $request)
    {

        $user = auth()->user();

        $newTicketArray = [
            'title' => $request->title,
            'user_id' => $user->id,
            'created_at' => time(),
            'mode' => 'open',
            'category_id' => $request->category_id,
            'attach' => $request->attach
        ];

        $newTicket = Tickets::insertGetId($newTicketArray);

        $newMsgArray = [
            'ticket_id' => $newTicket,
            'msg' => $request->msg,
            'created_at' => time(),
            'user_id' => $user->id,
            'mode' => 'user',
            'attach' => $request->attach
        ];

        $newMsg = TicketsMsg::insert($newMsgArray);

        ## Notification Center
        //sendNotification(0, ['[t.title]' => $request->title], get_option('notification_template_ticket_new'), 'user', $user->id);

        return back();

    }

    public function ticketReply($id)
    {
        $user = auth()->user();
        $wherein = TicketsUser::where('user_id', $user->id)->where('ticket_id', $id)->pluck('ticket_id');
        $ticket = Tickets::with(['messages' => function ($q) {
            $q->orderBy('id', 'DESC');
        }])->where(function ($w) use ($user, $wherein) {
            $w->where('user_id', $user->id)->orwhereIn('id', $wherein->toArray());
        })->where('id', $id)->first();

        ## Update Notification
        foreach ($ticket->messages as $msgUpdate) {
            TicketsMsg::where('mode', '<>', 'user')->where('id', $msgUpdate->id)->update(['view' => 1]);
        }
        return view(getTemplate() . '.user.ticket.reply', ['ticket' => $ticket]);
    }

    public function ticketReplyStore(Request $request)
    {
        $user = auth()->user();
        $ticket = Tickets::find($request->ticket_id);
        $ticket_user = TicketsUser::where('ticket_id', $request->ticket_id)->where('user_id', $user->id)->first();
        if ($ticket->user_id == $user->id || $ticket_user) {
            $insertArray = [
                'created_at' => time(),
                'ticket_id' => $request->ticket_id,
                'attach' => $request->attach,
                'user_id' => $user->id,
                'mode' => 'user',
                'msg' => $request->msg
            ];
            TicketsMsg::insert($insertArray);
            if ($ticket->mode == 'close') {
                $ticket->update(['mode' => 'open']);
            }
        }
        return back();
    }

    public function ticketClose($id)
    {
        $user = auth()->user();
        $ticket = Tickets::where('user_id', $user->id)->find($id);
        $ticket->update(['mode' => 'close']);
        return back();
    }

    public function ticketComments(Request $request)
    {
        $user = auth()->user();
        $userContent = Content::where('user_id', $user->id)->where('mode', 'publish')->pluck('id')->toArray();
        $comments = ContentComment::with(['user', 'content'])->whereIn('content_id', $userContent)->Where('mode', 'publish')->orderBy('id', 'DESC');
        $count = $comments->count();
        if ($request->get('p', null) != null)
            $comments->skip($request->get('p', null) * 20);

        $comments->take(20);
        return view(getTemplate() . '.user.ticket.commentList', ['lists' => $comments->get(), 'count' => $count]);
    }

    public function ticketNotifications(Request $request)
    {
        $user = auth()->user();
        $notifications = Notification::whereIn('recipent_type', ['user', 'userone'])
            ->where('recipent_list', $user->id)
            ->orWhere('recipent_type', 'all')
            ->where('mode', 'publish')
            ->orderBy('id', 'DESC');

        $count = $notifications->count();
        if ($request->get('p', null) != null)
            $notifications->skip($request->get('p', null) * 20);

        $notifications->take(20);

        return view(getTemplate() . '.user.ticket.notificationList', ['lists' => $notifications->get(), 'count' => $count]);
    }

    public function ticketSupport()
    {
        $user = auth()->user();
        $support = Content::with(['supports' => function ($q) {
            $q->with(['sender'])->where('mode', 'publish');
        }])->where('user_id', $user->id)->where('mode', 'publish')->get();
        return view(getTemplate() . '.user.ticket.supportList', ['supports' => $support]);
    }

    public function ticketSupportJson($content_id, $sender_id)
    {
        $user = auth()->user();
        if (!$user)
            return abort(404);

        $supports = ContentSupport::with(['sender' => function ($q) {
            $q->select('id', 'name', 'username');
        }])
            ->where('content_id', $content_id)
            ->where('sender_id', $sender_id)
            ->get();

        foreach ($supports as $index => $sup) {
            if ($sup->user_id != $sup->supporter_id && $sup->mode != 'publish')
                $supports->forget($index);
        }
        return $supports;
    }

    public function ticketSupportStore(Request $request)
    {
        $user = auth()->user();
        if (!$user)
            return abort(404);

        $content = Content::where('id', $request->content_id)->where('mode', 'publish')->where('user_id', $user->id)->first();
        if (!$content)
            return abort(404);

        $support = ContentSupport::create([
            'comment' => $request->comment,
            'user_id' => $user->id,
            'supporter_id' => $user->id,
            'sender_id' => $request->sender_id,
            'created_at' => time(),
            'name' => $user->name,
            'content_id' => $request->content_id,
            'rate' => '0',
            'mode' => 'draft'
        ]);

        if ($support->id)
            return $support;
    }

    ##############
    #### Sell ####
    ##############
    public function sellDownload(Request $request)
    {
        $user = auth()->user();
        $sellList = Sell::with(['buyer', 'content.metas', 'transaction', 'rate'])->where('user_id', $user->id)->orderBy('id', 'DESC');
        $count = $sellList->count();
        if ($request->get('p') != null)
            $sellList->skip($request->get('p') * 20);
        $sellList->take(20);

        ## Update Notifications
        Sell::where('user_id', $user->id)->where('type', 'download')->update(['view' => 1]);

        return view(getTemplate() . '.user.sell.download', ['lists' => $sellList->get(), 'count' => $count]);
    }

    public function sellPost(Request $request)
    {
        $user = auth()->user();
        $sellList = Sell::with(['buyer', 'content', 'transaction'])->where('user_id', $user->id)->where('type', 'post')->where(function ($q) {
            $q->where('post_code', null)->orwhere('post_code', '')->orWhere('post_confirm', '')->orWhere('post_confirm', null);
        })->get();
        $count = $sellList->count();
        if ($request->get('p') != null)
            $sellList->skip($request->get('p') * 20);
        $sellList->take(20);

        return view(getTemplate() . '.user.sell.post', ['lists' => $sellList, 'count' => $count]);
    }

    public function setPostalCode(Request $request)
    {
        $user = auth()->user();
        $Sell = Sell::where('user_id', $user->id)->find($request->sell_id);
        if (!$Sell)
            return redirect()->back()->with('msg', trans('main.failed_update'));

        if ($request->post_code == null)
            return redirect()->back()->with('msg', trans('main.parcel_tracking_code'));

        $Sell->post_code = $request->post_code;
        $Sell->post_code_date = time();
        $Sell->save();
        setNotification($user->id, 'sell', $request->sell_id);
        return redirect()->back()->with('msg', trans('main.parcel_tracking_success'));
    }

    public function balanceLogs(Request $request)
    {
        $user = auth()->user();
        $logs = Balance::with(['user', 'exporter'])->where('user_id', $user->id)->orderBy('id', 'DESC');
        $count = $logs->count();
        if ($request->get('p') != null)
            $logs->skip($request->get('p') * 20);
        $logs->take(20);
        return view(getTemplate() . '.user.balance.log', ['lists' => $logs->get(), 'count' => $count]);
    }

    public function balanceCharge()
    {
        $user = auth()->user();
        return view(getTemplate() . '.user.balance.charge', ['user' => $user]);
    }

    public function balanceChargePay(Request $request)
    {
        $user = auth()->user();
        if (!is_numeric($request->price) || $request->price == 0)
            return redirect()->back()->with('msg', trans('main.number_only'));

        if ($request->type == 'paypal') {
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
            $redirect_urls->setReturnUrl(url('/') . '/payment/wallet/status')
                ->setCancelUrl(url('/') . '/payment/wallet/cancel');
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
                'user_id' => $user->id,
                'price' => $request->price,
                'mode' => 'pending',
                'authority' => $payment->getId(),
                'created_at' => time(),
                'bank' => 'paypal'
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
        if ($request->type == 'income') {
            if ($request->price <= $user->income) {
                User::find($user->id)->update([
                    'income' => $user->income - $request->price,
                    'credit' => $user->credit + $request->price
                ]);
                Balance::create([
                    'title' => trans('main.user_account_charge'),
                    'description' => trans('main.account_charged'),
                    'type' => 'add',
                    'price' => $request->price,
                    'mode' => 'auto',
                    'user_id' => $user->id,
                    'exporter_id' => 0,
                    'created_at' => time()
                ]);
                Balance::create([
                    'title' => trans('main.income_deduction'),
                    'description' => trans('main.charge_transfer'),
                    'type' => 'minus',
                    'price' => $request->price,
                    'mode' => 'auto',
                    'user_id' => $user->id,
                    'exporter_id' => 0,
                    'created_at' => time()
                ]);
                return redirect()->back()->with('msg', trans('main.account_charged_success'));
            } else {
                return redirect()->back()->with('msg', trans('main.income_not_enough'));
            }
        }
        if ($request->type == 'paytm') {
            $payment = PaytmWallet::with('receive');
            $Transaction = TransactionCharge::create([
                'user_id' => $user->id,
                'price' => $request->price,
                'mode' => 'pending',
                'authority' => $payment->getId(),
                'created_at' => time(),
                'bank' => 'paytm'
            ]);
            $payment->prepare([
                'order' => $Transaction->id,
                'user' => $user->id,
                'email' => $user->email,
                'mobile_number' => '00187654321',
                'amount' => $Transaction->price,
                'callback_url' => url('/') . '/payment/wallet/status?gateway=paytm'
            ]);

            return $payment->receive();
        }
        if ($request->type == 'paystack') {
            $payStack = new \Unicodeveloper\Paystack\Paystack();
            $Transaction = TransactionCharge::create([
                'user_id' => $user->id,
                'price' => $request->price,
                'mode' => 'pending',
                'authority' => 0,
                'created_at' => time(),
                'bank' => 'paystack'
            ]);
            $payStack->getAuthorizationResponse([
                "amount" => $request->price,
                "reference" => Paystack::genTranxRef(),
                "email" => $user->email,
                "callback_url" => url('/') . '/payment/wallet/status?gateway=paystack',
                'metadata' => json_encode(['transaction' => $Transaction->id])
            ]);
            return redirect($payStack->url);
        }
        if ($request->type == 'razorpay') {
            $razorpay = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));
            $Transaction = TransactionCharge::create([
                'user_id' => $user->id,
                'price' => $request->price,
                'mode' => 'pending',
                'authority' => 0,
                'created_at' => time(),
                'bank' => 'razorpay'
            ]);
            $order = $razorpay->order->create(['receipt' => $Transaction->id, 'amount' => $Transaction->price, 'currency' => 'INR']);
            $Transaction->update(['authority' => $order['id']]);
            $payments = $razorpay->order->fetch($order['id'])->payments();
            $links = $razorpay->invoice->all();
            return '
                    <form action="' . url('/') . '/payment/wallet/status?gateway=razorpay" method="POST">
                    <script
                        src="https://checkout.razorpay.com/v1/checkout.js"
                        data-key="' . env('RAZORPAY_KEY_ID') . '" // Enter the Test API Key ID generated from Dashboard → Settings → API Keys
                        data-amount="' . $Transaction->price . '" 
                        data-currency="INR"
                        data-order_id="' . $order['id'] . '"
                        data-buttontext="Pay with Razorpay"
                        data-name=""
                        data-description=""
                        data-image=""
                        data-prefill.name=""
                        data-prefill.email=""
                        data-theme.color="#F37254"></script>
                       <input type="hidden" name="_token" value="' . csrf_token() . '">
                    </form>';
        }

        return redirect()->back()->with('msg', trans('main.feature_disabled'));

    }

    public function balanceReport(Request $request)
    {
        $user = auth()->user();
        $sells = Sell::with(['transaction'])->where('user_id', $user->id)->where('mode', 'pay')->orderBy('created_at', 'DESC');
        if ($request->get('first_date') != null) {
            $first_date = strtotime($request->get('first_date'));
            $sells->where('created_at', '>', $first_date);
        } else {
            $first_date = Sell::with(['transaction'])->where('user_id', $user->id)->where('mode', 'pay')->orderBy('created_at', 'DESC')->first();
            if ($first_date)
                $first_date = $first_date->created_at;
            else
                $first_date = time();
        }

        if ($request->get('last_date') != null) {
            $last_date = strtotime($request->get('last_date'));
            $sells->where('created_at', '<', $last_date);
        } else {
            $last_date = time();
        }
        $days = ($last_date - $first_date) / 86400;
        $prices = 0;
        $income = 0;
        foreach ($sells->get() as $stc) {
            $prices += $stc->transaction->price;
            $income += $stc->transaction->income;
        }

        for ($i = 1; $i < 13; $i++) {
            $curentYear = date('Y', time());
            $firstDate = mktime('12', '0', '0', $i, '1', $curentYear);
            $lastDate = mktime('12', '0', '0', $i + 1, '1', $curentYear);
            $chart['sell'][$i] = Sell::where('user_id', $user->id)->where('mode', 'pay')->where('created_at', '>', $firstDate)->where('created_at', '<', $lastDate)->count();
            $chart['income'][$i] = Transaction::where('user_id', $user->id)->where('mode', 'deliver')->where('created_at', '>', $firstDate)->where('created_at', '<', $lastDate)->sum('income');
        }

        return view(getTemplate() . '.user.balance.report', ['user' => $user, 'first_date' => $request->first_date, 'last_date' => $request->last_date, 'days' => $days, 'sellcount' => $sells->count(), 'prices' => $prices, 'income' => $income, 'chart' => $chart]);
    }

    ##############
    #### vimeo ####
    ##############
    function file_get_contents_chunked($file, $chunk_size, $callback)
    {
        try
        {
            $handle = fopen($file, "r");
            $i = 0;
            while (!feof($handle))
            {
                call_user_func_array($callback,array(fread($handle,$chunk_size),&$handle,$i));
                $i++;
            }

            fclose($handle);

        }
        catch(Exception $e)
        {
            trigger_error("file_get_contents_chunked::" . $e->getMessage(),E_USER_NOTICE);
            return false;
        }

        return true;
    }

    public function vimeoDownload(Request $request)
    {
        $user = auth()->user();
        $link           = $request->link;
        $Vimeo          = new Vimeo();
        $downloadLink   = $Vimeo->getVimeoDirectUrl($link);
        if(!file_exists(getcwd().'/bin/'.$user['username']))
            mkdir(getcwd().'/bin/'.$user['username']);
        file_put_contents(getcwd().'/bin/'.$user['username'].'/'.Str::random(16).'.mp4',file_get_contents($downloadLink));
        return 'ok';
    }

    ## Become Vendor ##
    public function becomeVendor()
    {
        return redirect('/user/ticket?type=become_vendor');
    }


    public function userActive($token)
    {
        $user = User::where('token', $token)->first();

        if ($user) {
            $user->update(['mode' => 'active']);
            sendMail(['template' => get_option('user_register_wellcome_email'), 'recipent' => [$user->email]]);
        } else {
            return abort(404);
        }

        //return view(getTemplate() . '.auth.active');
        return redirect('/login')->with('msg', 'Ya puede iniciar sesión.')->with('type', 'success');
    }

    public function forgetPassword(Request $request)
    {
        $str = Str::random();
        $email = $request->get('email', null);

        if (!empty($email)) {
            $update = User::where('email', $email)->update(['token' => $str]);
            if ($update) {
                sendMail(['template' => get_option('user_register_reset_email'), 'recipent' => [$request->email]]);
                return back()->with('msg', trans('main.pass_change_link'))->with('type', 'success');
            } else {
                return back()->with('msg', trans('main.user_not_found'))->with('type', 'warning');
            }
        }

        return back();
    }

    public function resetToken($token)
    {
        $user = User::where('token', $token)->first();
        $user->update(['password' => encrypt(Str::random(6))]);
        sendMail(['template' => get_option('user_register_new_password_email'), 'recipent' => [$user->email]]);
        return redirect('/')->with('msg', trans('main.new_pass_email'))->with('type', 'success');
    }

    public function googleLogin()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleDoLogin(Request $request)
    {
        session()->put('state', $request->input('state'));
        $user = Socialite::driver('google')->user();
        $newUser = [
            'username' => $user->name,
            'created_at' => time(),
            'admin' => 0,
            'email' => $user->email,
            'token' => $user->token,
            'password' => encrypt(str_random(10)),
            'mode' => 'active',
            'category_id' => get_option('user_default_category'),
        ];
        $ifUserExist = User::where('email', $newUser['email'])->first();

        if (empty($ifUserExist)) {
            $insertUser = User::create($newUser);
            $request->session()->put('user', serialize($insertUser));
            return redirect('/user/profile');
        } else {
            $request->session()->put('user', serialize($ifUserExist->toArray()));
            return redirect('/user/dashboard');
        }
    }

    ## Register Steps
    public function registerStepOne($phone)
    {
        $checkPhone = User::where('username', $phone)->count();
        if ($checkPhone > 0)
            return ['status' => 'error', 'description' => 'duplicate'];

        $random = random_int(11111, 99999);
        $newUser = User::create([
            'username' => $phone,
            'code' => $random,
            'admin' => 0,
            'created_at' => time()
        ]);
        if ($newUser) {
            sendSms($phone, $random);
            return ['status' => 'success', 'id' => $newUser->id];
        }
        return ['status' => 'error', 'description' => 'create'];
    }

    public function registerStepTwo($phone, $code)
    {
        $checkPhone = User::where('username', $phone)->where('mode', null)->where('password', null)->first();
        if (!$checkPhone || $checkPhone->code == null) {
            return ['status' => 'error', 'error' => '-1', 'description' => 'not found'];
        }
        if ($checkPhone->code != $code) {
            return ['status' => 'error', 'error' => '0', 'description' => 'code not correct'];
        }
        return ['status' => 'success'];
    }

    public function registerStepTwoRepeat($phone)
    {
        $checkPhone = User::where('username', $phone)->where('mode', null)->where('password', null)->first();
        if ($checkPhone) {
            $random = random_int(11111, 99999);
            $checkPhone->update(['code' => $random]);
            sendSms($phone, $random);
            return ['status' => 'success'];
        }
        return ['status' => 'error', 'error' => '-1', 'description' => 'not found'];
    }

    public function registerStepThree($phone, $code, Request $request)
    {
        $checkPhone = User::where('username', $phone)->where('mode', null)->where('password', null)->first();
        if (!$checkPhone || $checkPhone->code == null) {
            return ['status' => 'error', 'error' => '-1', 'description' => 'not found'];
        }
        if ($checkPhone->code != $code) {
            return ['status' => 'error', 'error' => '0', 'description' => 'code not correct'];
        }

        if ($request->password != $request->repassword) {
            return ['status' => 'error', 'error' => '2', 'description' => 'password not same'];
        }

        $checkPhone->update([
            'password' => encrypt($request->password),
            'name' => $request->name,
            'email' => $request->email,
            'mode' => 'active',
            'category_id' => get_option('user_default_category', 0),
            'token' => str_random(15)
        ]);

        ## Send Suitable Email For New User ##
        /*
        if(get_option('user_register_mode') == 'deactive')
            sendMail(['template' => get_option('user_register_active_email'), 'recipent' => [$checkPhone->email]]);
        else
            sendMail(['template'=>get_option('user_register_wellcome_email'),'recipent'=>[$checkPhone->email]]);
        */

        $request->session()->put('user', serialize($checkPhone->toArray()));
        return ['status' => 'success'];
    }

    public function userFollow($id)
    {
        $user = auth()->user();
        if (empty($user)) {
            return redirect('/user');
        }

        $follow_count = Follower::where('user_id', $id)->where('follower', $user->id)->count();

        if ($follow_count > 0) {
            return back();
        } else {
            Follower::insert(['user_id' => $id, 'follower' => $user->id]);

            ## Notification Center
            sendNotification(0, ['[u.name]' => $user->name], get_option('notification_template_request_follow'), 'user', $id);

            return back();
        }
    }

    public function userUnFollow($id)
    {
        $user = auth()->user();
        if (empty($user)) {
            return redirect('/user');
        }
        Follower::where('user_id', $id)->where('follower', $user->id)->delete();
        return back();
    }

    ## Show Profile For All Users ##
    public function userProfileView($id)
    {
        $userContentsQuery = Content::where('user_id', $id)->where('mode', 'publish');

        $user = auth()->check() ? auth()->user() : false;

        $profile = User::where('id', $id)->with('usermetas')->first();


        $videos = $userContentsQuery->with('metas')->get();


        $videosRate = $userContentsQuery->where('support_rate', '>', 0)->with('metas')->get();

        $channels = Channel::where('mode', 'active')->where('user_id', $id)->get();

        $followQuery = Follower::where('user_id', $id);
        $follow_count = $followQuery->count();

        $articles = Article::where('user_id', $id)
            ->where('mode', 'publish')
            ->orderBy('id', 'DESC')
            ->get();

        $record = Record::where('user_id', $id)
            ->where('mode', 'publish')
            ->with(['category'])
            ->orderBy('id', 'DESC')
            ->get();

        $menus = contentMenu();
        $rates = getRate($profile);

        $follow = 0;
        if (!empty($user)) {
            $follow = $followQuery->where('follower', $user->id)->count();
        }

        $duration = 0;
        foreach ($videos as $viid) {
            $meta = arrayToList($viid->metas, 'option', 'value');
            if (isset($meta['duration']))
                $duration += $meta['duration'];
        }

        ## Retes
        $video_id_array = $videos->pluck('id')->toArray();
        $video_rate = ContentRate::whereIn('content_id', $video_id_array)->avg('rate');


        $article_id_array = $articles->pluck('id')->toArray();
        $article_rate = ArticleRate::whereIn('article_id', $article_id_array)->avg('rate');

        $sells_id_array = Sell::where('user_id', $id)->where('mode', 'pay')->get()->pluck('id');

        $sell_rate = SellRate::whereIn('sell_id', $sells_id_array)->avg('rate');

        if (empty($profile)) {
            return redirect('/');
        }

        $data = [
            'profile' => $profile,
            'videos' => $videos,
            'channels' => $channels,
            'follow' => $follow,
            'duration' => $duration,
            'follow_count' => $follow_count,
            'rates' => $rates,
            'articles' => $articles,
            'menus' => $menus,
            'record' => $record,
            'support_rate' => round($videosRate->avg('support_rate'), 1),
            'video_rate' => round($video_rate, 1),
            'article_rate' => round($article_rate, 1),
            'sell_rate' => round($sell_rate, 1),
            'meta' => arrayToList($profile->usermetas, 'option', 'value')
        ];

        return view(getTemplate() . '.view.profile.profile', $data);
    }

    public function profileRequestStore(Request $request)
    {
        $user = auth()->user();
        if ($user == null) {
            return redirect()->back()->with('msg', trans('main.login_request'));
        }

        Requests::create([
            'user_id' => $request->user_id,
            'requester_id' => $user->id,
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'mode' => 'draft',
            'created_at' => time()
        ]);
        return redirect()->back()->with('msg', trans('main.req_success'));

    }

    private function saveUserAvatar($user, $image, $name)
    {
        $path = 'bin/media/users/' . $user->id;
        $img = \Image::make($image);

        if (!\File::exists($path)) {
            \File::makeDirectory($path);
        }

        $img_name = $user->username . '_' . $name . '.' . $image->getClientOriginalExtension();

        // save Main image
        $fileLocation = $path . "/" . $img_name;

        if (\File::exists(public_path($fileLocation))) {
            \File::delete([$fileLocation]);
        }

        $move = \File::put($fileLocation, (string)$img->encode());
        if ($move) {
            return $fileLocation;
        }
        return false;
    }


    ######################
    ### Bank Section ##
    ######################
    ## Paypal
    public function paypalPay($id, $mode = 'download')
    {
        $user = (auth()->check()) ? auth()->user() : false;
        if (!$user)
            return Redirect::to('/user?redirect=/product/' . $id);

        $content = Content::with('metas')->where('mode', 'publish')->find($id);
        if (!$content)
            abort(404);

        if ($content->private == 1)
            $site_income = get_option('site_income_private');
        else
            $site_income = get_option('site_income');

        ## Vendor Group Percent
        $Vendor = User::with(['category'])->find($content->user_id);
        if(isset($Vendor) && isset($Vendor->category->commision) && ($Vendor->category->commision > 0)){
            $site_income = $site_income - $Vendor->category->commision;
        }
        ## Vendor Rate Percent
        if($Vendor){
            $Rates = getRate($Vendor->toArray());
            if($Rates){
                $RatePercent = 0;
                foreach ($Rates as $rate){
                    $RatePercent += $rate['commision'];
                }

                $site_income = $site_income - $RatePercent;
            }
        }

        $meta = arrayToList($content->metas, 'option', 'value');

        if ($mode == 'download')
            $Amount = $meta['price'];
        elseif ($mode == 'post')
            $Amount = $meta['post_price'];

        $Description = trans('admin.item_purchased') . $content->title . trans('admin.by') . $user['name']; // Required
        $Amount_pay = pricePay($content->id, $content->category_id, $Amount)['price'];


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
        $redirect_urls->setReturnUrl(url('/') . '/bank/paypal/status')
            ->setCancelUrl(url('/') . '/bank/paypal/cancel/' . $id);
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
            'buyer_id' => $user['id'],
            'user_id' => $content->user_id,
            'content_id' => $content->id,
            'price' => $Amount_pay,
            'price_content' => $Amount,
            'mode' => 'pending',
            'created_at' => time(),
            'bank' => 'paypal',
            'income' => $Amount_pay - (($site_income / 100) * $Amount_pay),
            'authority' => $ids,
            'type' => $mode
        ]);
        /** add payment ID to session **/
        if (isset($redirect_url)) {
            /** redirect to paypal **/
            return Redirect::away($redirect_url);
        }
        \Session::put('error', 'Unknown error occurred');
        return Redirect::route('paywithpaypal');

    }

    public function paytmPay(Request $request, $id, $mode = 'download')
    {
        $user = (auth()->check()) ? auth()->user() : false;
        if (!$user)
            return Redirect::to('/user?redirect=/product/' . $id);

        $content = Content::with('metas')->where('mode', 'publish')->find($id);
        if (!$content)
            abort(404);

        if ($content->private == 1)
            $site_income = get_option('site_income_private');
        else
            $site_income = get_option('site_income');

        ## Vendor Group Percent
        $Vendor = User::with(['category'])->find($content->user_id);
        if(isset($Vendor) && isset($Vendor->category->commision) && ($Vendor->category->commision > 0)){
            $site_income = $site_income - $Vendor->category->commision;
        }

        $meta = arrayToList($content->metas, 'option', 'value');

        if ($mode == 'download')
            $Amount = $meta['price'];
        elseif ($mode == 'post')
            $Amount = $meta['post_price'];

        $Description = trans('admin.item_purchased') . $content->title . trans('admin.by') . $user['name']; // Required
        $Amount_pay = pricePay($content->id, $content->category_id, $Amount)['price'];
        ## Vendor Rate Percent
        if($Vendor){
            $Rates = getRate($Vendor->toArray());
            if($Rates){
                $RatePercent = 0;
                foreach ($Rates as $rate){
                    $RatePercent += $rate['commision'];
                }

                $site_income = $site_income - $RatePercent;
            }
        }

        $Transaction = Transaction::create([
            'buyer_id'      => $user['id'],
            'user_id'       => $content->user_id,
            'content_id'    => $content->id,
            'price'         => $Amount_pay,
            'price_content' => $Amount,
            'mode'          => 'pending',
            'create_at'     => time(),
            'bank'          => 'paytm',
            'authority'     => 0,
            'income'        => $Amount_pay - (($site_income/100)*$Amount_pay),
            'type'          => $mode
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

    public function payuPay(Request $request, $id, $mode = 'download')
    {
        $user = (auth()->check()) ? auth()->user() : false;
        if (!$user)
            return Redirect::to('/user?redirect=/product/' . $id);

        $content = Content::with('metas')->where('mode', 'publish')->find($id);
        if (!$content)
            abort(404);

        if ($content->private == 1)
            $site_income = get_option('site_income_private');
        else
            $site_income = get_option('site_income');

        ## Vendor Group Percent
        $Vendor = User::with(['category'])->find($content->user_id);
        if(isset($Vendor) && isset($Vendor->category->commision) && ($Vendor->category->commision > 0)){
            $site_income = $site_income - $Vendor->category->commision;
        }
        ## Vendor Rate Percent
        if($Vendor){
            $Rates = getRate($Vendor->toArray());
            if($Rates){
                $RatePercent = 0;
                foreach ($Rates as $rate){
                    $RatePercent += $rate['commision'];
                }

                $site_income = $site_income - $RatePercent;
            }
        }

        $meta = arrayToList($content->metas, 'option', 'value');

        if ($mode == 'download')
            $Amount = $meta['price'];
        elseif ($mode == 'post')
            $Amount = $meta['post_price'];

        $Description = trans('admin.item_purchased') . $content->title . trans('admin.by') . $user['name']; // Required
        $Amount_pay = pricePay($content->id,$content->category_id,$Amount)['price'];
        $strRnd = str_random();
        $Transaction = Transaction::create([
            'buyer_id'      => $user['id'],
            'user_id'       => $content->user_id,
            'content_id'    => $content->id,
            'price'         => $Amount_pay,
            'price_content' => $Amount,
            'mode'          => 'pending',
            'create_at'     => time(),
            'bank'          => 'payu',
            'authority'     => $strRnd,
            'income'        => $Amount_pay - (($site_income/100)*$Amount_pay),
            'type'          => $mode
        ]);

        $attributes = [
            'txnid'         => $strRnd, # Transaction ID.
            'amount'        => $Amount_pay, # Amount to be charged.
            'productinfo'   => $content->title,
            'firstname'     => "John", # Payee Name.
            'email'         => "john@doe.com", # Payee Email Address.
            'phone'         => "9876543210", # Payee Phone Number.
            'surl'          => url('/').'/bank/payu/status/'.$content->id,
            'furl'          => url('/').'/bank/payu/status/'.$content->id,
        ];

        /*
        $Payu = new ([
            'KEY'       => env('PAYU_KEY'),
            'SALT'      => env('PAYU_SALT'),
            'TEST_MODE' => env('PAYU_TEST_MODE'),
            'DEBUG'     => false
        ]);
        $Payu->pay($attributes)->send();
        */
    }

    public function paystackPay(Request $request, $id, $mode = 'download')
    {
        $user = (auth()->check()) ? auth()->user() : false;
        if (!$user)
            return Redirect::to('/user?redirect=/product/' . $id);

        $content = Content::with('metas')->where('mode', 'publish')->find($id);
        if (!$content)
            abort(404);

        if ($content->private == 1)
            $site_income = get_option('site_income_private');
        else
            $site_income = get_option('site_income');

        ## Vendor Group Percent
        $Vendor = User::with(['category'])->find($content->user_id);
        if(isset($Vendor) && isset($Vendor->category->commision) && ($Vendor->category->commision > 0)){
            $site_income = $site_income - $Vendor->category->commision;
        }
        ## Vendor Rate Percent
        if($Vendor){
            $Rates = getRate($Vendor->toArray());
            if($Rates){
                $RatePercent = 0;
                foreach ($Rates as $rate){
                    $RatePercent += $rate['commision'];
                }

                $site_income = $site_income - $RatePercent;
            }
        }

        $meta = arrayToList($content->metas, 'option', 'value');

        if ($mode == 'download')
            $Amount = $meta['price'];
        elseif ($mode == 'post')
            $Amount = $meta['post_price'];

        $Description = trans('admin.item_purchased') . $content->title . trans('admin.by') . $user['name']; // Required
        $Amount_pay = pricePay($content->id, $content->category_id, $Amount)['price'];

        $Transaction = Transaction::create([
            'buyer_id' => $user['id'],
            'user_id' => $content->user_id,
            'content_id' => $content->id,
            'price' => $Amount_pay,
            'price_content' => $Amount,
            'mode' => 'pending',
            'created_at' => time(),
            'bank' => 'paystack',
            'authority' => 0,
            'income' => $Amount_pay - (($site_income / 100) * $Amount_pay),
            'type' => $mode
        ]);
        $payStack = new \Unicodeveloper\Paystack\Paystack();
        $payStack->getAuthorizationResponse([
            "amount" => $Amount_pay,
            "reference" => Paystack::genTranxRef(),
            "email" => $user['email'],
            "callback_url" => url('/') . '/bank/paystack/status/' . $content->id,
            'metadata' => json_encode(['transaction' => $Transaction->id])
        ]);
        return redirect($payStack->url);
    }

    public function razorpayPay(Request $request, $id, $mode = 'download')
    {
        $user = (auth()->check()) ? auth()->user() : false;
        if (!$user)
            return Redirect::to('/user?redirect=/product/' . $id);

        $content = Content::with('metas')->where('mode', 'publish')->find($id);
        if (!$content)
            abort(404);

        if ($content->private == 1)
            $site_income = get_option('site_income_private');
        else
            $site_income = get_option('site_income');

        ## Vendor Group Percent
        $Vendor = User::with(['category'])->find($content->user_id);
        if(isset($Vendor) && isset($Vendor->category->commision) && ($Vendor->category->commision > 0)){
            $site_income = $site_income - $Vendor->category->commision;
        }
        ## Vendor Rate Percent
        if($Vendor){
            $Rates = getRate($Vendor->toArray());
            if($Rates){
                $RatePercent = 0;
                foreach ($Rates as $rate){
                    $RatePercent += $rate['commision'];
                }

                $site_income = $site_income - $RatePercent;
            }
        }

        $meta = arrayToList($content->metas, 'option', 'value');

        if ($mode == 'download')
            $Amount = $meta['price'];
        elseif ($mode == 'post')
            $Amount = $meta['post_price'];

        $Description = trans('admin.item_purchased') . $content->title . trans('admin.by') . $user['name']; // Required
        $Amount_pay = pricePay($content->id, $content->category_id, $Amount)['price'];

        $Transaction = Transaction::create([
            'buyer_id' => $user['id'],
            'user_id' => $content->user_id,
            'content_id' => $content->id,
            'price' => $Amount_pay,
            'price_content' => $Amount,
            'mode' => 'pending',
            'created_at' => time(),
            'bank' => 'razorpay',
            'authority' => 0,
            'income' => $Amount_pay - (($site_income / 100) * $Amount_pay),
            'type' => $mode
        ]);

        $razorpay = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));
        $order = $razorpay->order->create(['receipt' => $Transaction->id, 'amount' => $Transaction->price, 'currency' => 'INR']);
        $Transaction->update(['authority' => $order['id']]);
        return '<form action="' . url('/') . '/bank/razorpay/status/' . $content->id.'" method="POST">
                    <script
                        src="https://checkout.razorpay.com/v1/checkout.js"
                        data-key="' . env('RAZORPAY_KEY_ID') . '"
                        data-amount="' . $Transaction->price . '" 
                        data-currency="INR"
                        data-order_id="' . $order['id'] . '"
                        data-buttontext="Pay with Razorpay"
                        data-name=""
                        data-description=""
                        data-image=""
                        data-prefill.name=""
                        data-prefill.email=""
                        data-theme.color="#F37254"></script>
                       <input type="hidden" name="_token" value="' . csrf_token() . '">
                    </form>';
    }

    public function paycomPay(Request $request, $id)
    {   
        $user = (auth()->check()) ? auth()->user() : false;

        $time = $request->time;
        $price = $request->item_price;
        $tohash = $user->id.'-'.$id.'|'.number_format($price, 2, '.', '').'|'.$time.'|k9xSedmEThFPFjJzHA7kwNFzhXLj4C6G';
        //$tohash = '|'.$price.'.00|'.$time.'|k9xSedmEThFPFjJzHA7kwNFzhXLj4C6G';
        $hash = md5($tohash);
        $mode = $request->method_creditDebit;

        $params = [
            'username' => "jbonillap201",
            'type' => 'auth',
            'key_id' => '38723344',
            'hash' => $hash,
            'time' => $time,
            //'transactionid' => '1234567',
            //'amount' => $price.'.00',
            'amount' => number_format($price, 2, '.', ''),
            'orderid' => $user->id.'-'.$id,
            'processor_id' => 'RPGT0728',
            'ccnumber' => $request->ccnumber,
            'ccexp' => $request->ccexp,
            'cvv' => $request->ccccv,
            'avs' => 'Tzenik',
        ];

        $client = new Client(['verify' => '../cacert.pem']);
        $url = "https://paycom.credomatic.com/PayComBackEndWeb/common/requestPaycomService.go";
        $send = $client->request('POST', $url, [
            'form_params' => $params,
        ]);
        
        $get_url = ltrim($send->getbody(), '?');
        parse_str($get_url, $url_toJson);
        
        //return $url_toJson;
        if($url_toJson['response'] == 1){
            
            if (!$user)
                return Redirect::to('/user?redirect=/product/' . $id);

            $content = Content::with('metas')->where('mode', 'publish')->find($id);
            if (!$content)
                abort(404);

            if ($content->private == 1)
                $site_income = get_option('site_income_private');
            else
                $site_income = get_option('site_income');

            ## Vendor Group Percent
            $Vendor = User::with(['category'])->find($content->user_id);
            if(isset($Vendor) && isset($Vendor->category->commision) && ($Vendor->category->commision > 0)){
                $site_income = $site_income - $Vendor->category->commision;
            }
            ## Vendor Rate Percent
            if($Vendor){
                $Rates = getRate($Vendor->toArray());
                if($Rates){
                    $RatePercent = 0;
                    foreach ($Rates as $rate){
                        $RatePercent += $rate['commision'];
                    }

                    $site_income = $site_income - $RatePercent;
                }
            }

            $meta = arrayToList($content->metas, 'option', 'value');

            if ($mode == 'download')
                $Amount = $meta['price'];
            elseif ($mode == 'post')
                $Amount = $meta['post_price'];

            $Description = trans('admin.item_purchased') . $content->title . trans('admin.by') . $user['name']; // Required
            $Amount_pay = pricePay($content->id, $content->category_id, $Amount)['price'];

            $Transaction = Transaction::create([
                'buyer_id' => $user['id'],
                'user_id' => $content->user_id,
                'content_id' => $content->id,
                'price' => $Amount_pay,
                'price_content' => $Amount,
                'mode' => 'pending',
                'created_at' => time(),
                'bank' => 'paycom',
                'authority' => $url_toJson['authcode'],
                'income' => $Amount_pay - (($site_income / 100) * $Amount_pay),
                'type' => $mode
            ]);

            //Chat_UsersInChat::where('chat_id', $content->chat_id)->insert(['user_id' => $user['id'], 'chat_id' => $content->chat_id]);

            if($content->type == 'coaching' || $content->type == 'webinar'){
                $part_date = ContentPart::where('content_id', $content->id)->first();
                CalendarEvents::create(['user_id' => $user->id, 'product_id' => $content->id, 
                'date' => $part_date->date, 'type' => $content->type, 'content' => 'Horario: '.$part_date->time]);
            }

            return redirect('/bank/paycom/status/'.$content->id.'/'.$Transaction->id);
        }else{
            return back()->with('msg', trans('Hubo un problema con tu tarjeta, verifica los datos.'))->with('type', 'warning');
        }

    }
    

    ## Credit Section
    public function creditPay($id, $mode = 'download')
    {
        $user = (auth()->check()) ? auth()->user() : false;
        if (!$user)
            return Redirect::to('/user?redirect=/product/' . $id);

        $content = Content::with('metas')->where('mode', 'publish')->find($id);
        if (!$content)
            abort(404);

        $seller = User::with('category')->find($content->user_id);

        if ($content->private == 1)
            $site_income = get_option('site_income_private');
        else
            $site_income = get_option('site_income');

        ## Vendor Group Percent
        $Vendor = User::with(['category'])->find($content->user_id);
        if(isset($Vendor) && isset($Vendor->category->commision) && ($Vendor->category->commision > 0)){
            $site_income = $site_income - $Vendor->category->commision;
        }
        ## Vendor Rate Percent
        if($Vendor){
            $Rates = getRate($Vendor->toArray());
            if($Rates){
                $RatePercent = 0;
                foreach ($Rates as $rate){
                    $RatePercent += $rate['commision'];
                }

                $site_income = $site_income - $RatePercent;
            }
        }

        $meta = arrayToList($content->metas, 'option', 'value');
        if ($mode == 'download' and !empty($meta['price']))
            $Amount = $meta['price'];
        elseif ($mode == 'post' and !empty($meta['post_price']))
            $Amount = $meta['post_price'];

        if (!empty($Amount)) {
            $Amount_pay = pricePay($content->id, $content->category_id, $Amount)['price'];
            if ($user['credit'] - $Amount_pay < 0) {
                return redirect('/product/' . $id)->with('msg', trans('admin.no_charge_error'));
            } else {
                $transaction = Transaction::create([
                    'buyer_id' => $user['id'],
                    'user_id' => $content->user_id,
                    'content_id' => $content->id,
                    'price' => $Amount_pay,
                    'price_content' => $Amount,
                    'mode' => 'deliver',
                    'created_at' => time(),
                    'bank' => 'credit',
                    'authority' => '000',
                    'income' => $Amount_pay - (($site_income / 100) * $Amount_pay),
                    'type' => $mode
                ]);
                Sell::insert([
                    'user_id' => $content->user_id,
                    'buyer_id' => $user['id'],
                    'content_id' => $content->id,
                    'type' => $mode,
                    'created_at' => time(),
                    'mode' => 'pay',
                    'transaction_id' => $transaction->id
                ]);

                $seller->update(['income' => $seller->income + ((100 - $site_income) / 100) * $Amount_pay]);
                $buyer = User::find($user['id']);
                $buyer->update(['credit' => $user['credit'] - $Amount_pay]);

                Balance::create([
                    'title' => trans('admin.item_purchased') . $content->title,
                    'description' => trans('admin.item_purchased_desc'),
                    'type' => 'minus',
                    'price' => $Amount_pay,
                    'mode' => 'auto',
                    'user_id' => $buyer->id,
                    'exporter_id' => 0,
                    'created_at' => time()
                ]);
                Balance::create([
                    'title' => trans('admin.item_sold') . $content->title,
                    'description' => trans('admin.item_sold_desc'),
                    'type' => 'add',
                    'price' => ((100 - $site_income) / 100) * $Amount_pay,
                    'mode' => 'auto',
                    'user_id' => $seller->id,
                    'exporter_id' => 0,
                    'created_at' => time()
                ]);
                Balance::create([
                    'title' => trans('admin.item_profit') . $content->title,
                    'description' => trans('admin.item_profit_desc') . $buyer->username,
                    'type' => 'add',
                    'price' => ($site_income / 100) * $Amount_pay,
                    'mode' => 'auto',
                    'user_id' => 0,
                    'exporter_id' => 0,
                    'created_at' => time()
                ]);
                Chat_UsersInChat::where('chat_id', $content->chat_id)->insert(['user_id' => $user['id'], 'chat_id' => $content->chat_id]);
                ## Notification Center
                $product = Content::find($transaction->content_id);
                sendNotification(0, ['[c.title]' => $product->title], get_option('notification_template_buy_new'), 'user', $buyer->id);
                return redirect()->back()->with('msg', trans('admin.item_purchased_success'));
            }
        }

        return back();
    }

    // *******
    // QuizzesList
    public function QuizzesList()
    {
        $user = auth()->user();

        $quizzesQuery = Quiz::query();

        /*if ($user->vendor) {
            $quizzes = $quizzesQuery->where('user_id', $user->id)
                ->with(['questions', 'content', 'QuizResults' => function ($query) {
                    $query->orderBy('status', 'desc');
                    $query->with('student');
                }])->get();

            foreach ($quizzes as $quiz) {
                $QuizResults = $quiz->QuizResults;
                $waiting_results = 0;
                $passed_results = 0;
                $total_grade = 0;
                foreach ($QuizResults as $result) {
                    if ($result->status == 'waiting') {
                        $waiting_results += 1;
                    } else if ($result->status == 'pass') {
                        $passed_results += 1;
                    }
                    $total_grade += (int)$result->user_grade;
                }

                $quiz->average_grade = ($total_grade > 0) ? round($total_grade / count($QuizResults), 2) : 0;
                $quiz->review_needs = $waiting_results;
            }
        */
        //} else {
            $quizzes = $quizzesQuery->where('status', 'active')
                ->with(['questionsGradeSum', 'content'])
                ->get();

            foreach ($quizzes as $quiz) {
                $quizResults = QuizResult::where('student_id', $user->id)
                    ->where('quiz_id', $quiz->id)
                    ->orderBy('id', 'desc')
                    ->get();

                $quiz->result = $quizResults->first();
                $quiz->result_count = count($quizResults);

                $sell = Sell::where('content_id', $quiz->content_id)->where('buyer_id', $user->id)->get();

                if(!$sell->isEmpty()){
                    $quiz->comprado = true;
                }else{
                    $quiz->comprado = false;
                }

                $quiz->can_try = true;
                if ((isset($quiz->attempt) and count($quizResults) >= $quiz->attempt) or (!empty($quiz->result) and $quiz->result->status === 'pass')) {
                    $quiz->can_try = false;
                }
            }
        //}

        $data = [
            'user' => $user,
            'quizzes' => $quizzes,
        ];

        //return $data;

        return view(getTemplate() . '.user.quizzes.list', $data);
    }

    public function vendorQuizzesList()
    {
        $user = auth()->user();

        $quizzesQuery = Quiz::query();

        $quizzes = $quizzesQuery->where('user_id', $user->id)
            ->with(['questions', 'content', 'QuizResults' => function ($query) {
                $query->orderBy('status', 'desc');
                $query->with('student');
            }])->get();

        foreach ($quizzes as $quiz) {
            $QuizResults = $quiz->QuizResults;
            $waiting_results = 0;
            $passed_results = 0;
            $total_grade = 0;
            foreach ($QuizResults as $result) {
                if ($result->status == 'waiting') {
                    $waiting_results += 1;
                } else if ($result->status == 'pass') {
                    $passed_results += 1;
                }
                $total_grade += (int)$result->user_grade;
            }

            $quiz->average_grade = ($total_grade > 0) ? round($total_grade / count($QuizResults), 2) : 0;
            $quiz->review_needs = $waiting_results;
        }

        $data = [
            'user' => $user,
            'quizzes' => $quizzes,
        ];

        //return $data;

        return view(getTemplate() . '.user.vendor.quizzes.list', $data);
    }

    public function newQuiz(){
        return view(getTemplate().'.user.vendor.quizzes.newquiz');
    }

    public function QuizzesStore(Request $request)
    {
        $user = auth()->user();
        $data = $request->except('_token');
        $rules = [
            'name' => 'required',
            'content_id' => 'required|numeric',
            'pass_mark' => 'required|numeric',
        ];
        $this->validate($request, $rules);

        $data['user_id'] = $user->id;
        $data['created_at'] = time();

        $quiz = Quiz::create($data);

        if ($quiz) {
            return redirect()->back()->with('msg', trans('main.quiz_created_msg'))->with('type', 'success');
        }

        return redirect()->back()->with('msg', trans('main.failed_store'))->with('type', 'danger');
    }

    public function QuizzesEdit($quiz_id)
    {
        $user = auth()->user();
        $quiz = Quiz::where('id', $quiz_id)
            ->where('user_id', $user->id)
            ->first();
        if (!empty($quiz)) {
            $data = [
                'user' => $user,
                'quiz' => $quiz,
            ];
            return view(getTemplate() . '.user.vendor.quizzes.newquiz', $data);
        }

        abort(404);
    }

    public function QuizzesUpdate(Request $request, $quiz_id)
    {
        $user = auth()->user();
        $quiz = Quiz::where('id', $quiz_id)
            ->where('user_id', $user->id)
            ->first();

        if (!empty($quiz)) {
            $data = $request->except('_token');
            $rules = [
                'name' => 'required',
                'content_id' => 'required|numeric',
                'pass_mark' => 'required|numeric',
            ];
            $this->validate($request, $rules);

            $results = QuizResult::where('quiz_id', $quiz->id)->get();
            foreach ($results as $result) {
                if ($result->user_grade >= $quiz->pass_mark) {
                    $result->status = 'pass';
                    $result->save();
                }
            }

            $data['updated_at'] = time();
            $quiz->update($data);

            return redirect('/user/vendor/quizzes')->with('msg', trans('main.quiz_updated_msg'))->with('type', 'success');
        }

        return back();
    }

    public function QuizzesDelete($quiz_id)
    {
        $user = auth()->user();
        $quiz = Quiz::where('id', $quiz_id)
            ->where('user_id', $user->id)
            ->first();

        if (!empty($quiz)) {
            $quiz->delete();
            return back()->with('msg', trans('main.quiz_delete_msg'))->with('type', 'success');
        }

        abort(404);
    }

    public function QuizzesQuestions($quiz_id)
    {
        $user = auth()->user();
        $quiz = Quiz::where('id', $quiz_id)
            ->where('user_id', $user->id)
            ->first();

        if (!empty($quiz)) {
            $data = [
                'quiz' => $quiz
            ];
            return view(getTemplate() . '.user.vendor.quizzes.questions', $data);
        }

        abort(404);
    }

    public function QuizzesQuestionsStore(Request $request, $quiz_id)
    {
        $user = auth()->user();
        $quiz = Quiz::where('id', $quiz_id)
            ->where('user_id', $user->id)
            ->first();

        if (!empty($quiz)) {
            $rules = [
                'title' => 'required',
                'grade' => 'required',
            ];
            $this->validate($request, $rules);

            $data = $request->except(['_token']);

            $question_data = [
                'user_id' => $user->id,
                'quiz_id' => $quiz->id,
                'title' => $data['title'],
                'grade' => $data['grade'],
                'type' => $data['type'],
                'created_at' => time(),
            ];
            $question = QuizzesQuestion::create($question_data);
            if ($question) {
                if (!empty($data['answers']) and count($data['answers'])) {
                    foreach ($data['answers'] as $answer) {
                        QuizzesQuestionsAnswer::create([
                            'user_id' => $user->id,
                            'question_id' => $question->id,
                            'title' => $answer['title'],
                            'image' => $answer['image'],
                            'correct' => $answer['correct'],
                            'created_at' => time(),
                        ]);
                    }
                }

                return back()->with('msg', trans('main.question_create_msg'))->with('type', 'success');
            }
        }

        abort(404);
    }

    public function QuizzesStart($quiz_id)
    {
        $user = auth()->user();

        $quiz = Quiz::where('id', $quiz_id)
            ->with(['questions' => function ($query) {
                $query->with(['questionsAnswers']);
            }, 'questionsGradeSum'])
            ->first();

        if ($quiz) {
            $attempt_count = $quiz->attempt;
            $userQuizDone = QuizResult::where('quiz_id', $quiz->id)
                ->where('student_id', $user->id)
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
                    'student_id' => $user->id,
                    'results' => '',
                    'user_grade' => '',
                    'status' => 'waiting',
                    'created_at' => time()
                ]);

                $data = [
                    'quiz' => $quiz,
                    'newQuizStart' => $newQuizStart
                ];

                return view(getTemplate() . '.user.quizzes.start', $data);
            } else {
                return back()->with('msg', trans('main.cant_start_quiz'))->with('type', 'warning');
            }
        }
        abort(404);
    }

    public function QuizzesStoreResult(Request $request, $quiz_id)
    {
        $user = auth()->user();
        $quiz = Quiz::where('id', $quiz_id)->first();
        if ($quiz) {
            $results = $request->get('question');
            $quiz_result_id = $request->get('quiz_result_id');

            if (!empty($quiz_result_id)) {
                $quiz_result = QuizResult::where('id', $quiz_result_id)
                    ->where('student_id', $user->id)
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

                    return redirect('/user/quizzes');
                }
            }
        }
        abort(404);
    }

    public function StudentQuizzesResults($result_id)
    {
        $user = auth()->user();
        $quiz_result = QuizResult::where('id', $result_id)
            ->where('student_id', $user->id)
            ->with(['quiz' => function ($query) {
                $query->with(['questions', 'questionsGradeSum']);
            }])
            ->first();

        if ($quiz_result) {
            $quiz = $quiz_result->quiz;
            $attempt_count = $quiz->attempt;
            $userQuizDone = QuizResult::where('quiz_id', $quiz->id)
                ->where('student_id', $user->id)
                ->count();

            $canTryAgain = false;
            if ($userQuizDone < $attempt_count) {
                $canTryAgain = true;
            }

            $data = [
                'quiz_result' => $quiz_result,
                'quiz' => $quiz,
                'canTryAgain' => $canTryAgain,
            ];
            return view(getTemplate() . '.user.quizzes.student_results', $data);
        }
        abort(404);
    }

    public function QuizzesResults($quiz_id)
    {
        $user = auth()->user();
        $quiz = Quiz::where('id', $quiz_id)
            ->where('user_id', $user->id)
            ->with(['content', 'questions', 'QuizResults' => function ($query) {
                $query->orderBy('status', 'desc');
                $query->with('student');
            }])
            ->first();

        if ($quiz) {
            $QuizResults = $quiz->QuizResults;
            $waiting_results = 0;
            $passed_results = 0;
            $total_grade = 0;
            foreach ($QuizResults as $result) {
                if ($result->status == 'waiting') {
                    $waiting_results += 1;
                } else if ($result->status == 'pass') {
                    $passed_results += 1;
                }
                $total_grade += (int)$result->user_grade;
            }

            $hasDescriptive = false;
            foreach ($quiz->questions as $question) {
                if ($question->type == 'descriptive') {
                    $hasDescriptive = true;
                }
            }

            $quiz->hasDescriptive = $hasDescriptive;

            $data = [
                'quiz' => $quiz,
                'QuizResults' => $QuizResults,
                'waitingResults' => $waiting_results,
                'passedResults' => $passed_results,
                'averageResults' => ($total_grade > 0) ? round($total_grade / count($QuizResults), 2) : 0,
            ];

            return view(getTemplate() . '.user.vendor.quizzes.results', $data);
        }
        abort(404);
    }

    public function QuizzesResultsDescriptive(Request $request)
    {
        $user = auth()->user();
        $result_id = $request->get('result_id');
        if ($result_id) {
            $descriptives = [];
            $QuizResult = QuizResult::findOrFail($result_id);
            $results = json_decode($QuizResult->results);

            if (!empty($results)) {
                foreach ($results as $question_id => $result) {
                    $question = QuizzesQuestion::where('id', $question_id)
                        ->where('user_id', $user->id)
                        ->first();
                    if (!empty($question) and $question->type == 'descriptive') {
                        $item = [
                            'question_id' => $question->id,
                            'question' => $question->title,
                            'question_grade' => $question->grade,
                            'result_grade' => (!empty($result->grade)) ? $result->grade : '',
                            'result_status' => $QuizResult->status,
                            'answer' => !empty($result->answer) ? $result->answer : ''
                        ];
                        $descriptives[] = $item;
                    }
                }
            }

            return response()->json([
                'data' => $descriptives,
            ], 200);
        }
    }

    public function QuizzesResultsReviewed(Request $request)
    {
        $user = auth()->user();
        $result_id = $request->get('result_id');

        if ($result_id) {
            $quizResult = QuizResult::findOrFail($result_id);
            $results = json_decode($quizResult->results);
            $reviews = $request->get('review');
            $user_grade = $quizResult->user_grade;

            foreach ($results as $question_id => $result) {
                foreach ($reviews as $question_id2 => $review) {
                    if ($question_id2 == $question_id) {
                        $question = QuizzesQuestion::where('id', $question_id)
                            ->where('user_id', $user->id)
                            ->first();

                        if (!empty($result->status) and $result->status) {
                            $user_grade = $user_grade - (isset($result->grade) ? (int)$result->grade : 0);
                            $user_grade = $user_grade + (isset($review['grade']) ? (int)$review['grade'] : (int)$question->grade);
                            $result->grade = isset($review['grade']) ? $review['grade'] : $question->grade;
                        } else if (isset($result->status) and !$result->status) {
                            $user_grade = $user_grade + (isset($review['grade']) ? (int)$review['grade'] : (int)$question->grade);
                            $result->grade = isset($review['grade']) ? $review['grade'] : $question->grade;
                        }

                        $result->status = true;
                    }
                }
            }

            $quizResult->user_grade = $user_grade;

            $pass_mark = $quizResult->quiz->pass_mark;

            if ($quizResult->user_grade >= $pass_mark) {
                $quizResult->status = 'pass';
            } else {
                $quizResult->status = 'fail';
            }

            $quizResult->results = json_encode($results);

            $quizResult->save();

            return back()->with('msg', trans('main.review_success'));
        }
        abort(404);
    }

    public function QuizzesDownloadCertificate($result_id)
    {
        $user = auth()->user();

        $result = QuizResult::where('id', $result_id)
            ->where('student_id', $user->id)
            ->where('status', 'pass')
            ->with(['quiz' => function ($query) {
                $query->with(['content']);
            }])
            ->first();

        if ($result and !empty($result->quiz)) {
            $quiz = $result->quiz;
            $certificateTemplate = CertificateTemplate::where('status', 'publish')->first();

            $img = Image::make(getcwd().$certificateTemplate->image);
            $body = $certificateTemplate->body;
            $body = str_replace('[user]', $user->name, $body);
            $body = str_replace('[course]', $quiz->content->title, $body);
            $body = str_replace('[grade]', $result->user_grade, $body);

            $img->text($body, $certificateTemplate->position_x, $certificateTemplate->position_y, function ($font) use ($certificateTemplate) {
                $font->file(public_path('assets/admin/fonts/nunito-v9-latin-regular.ttf'));
                $font->size($certificateTemplate->font_size);
                $font->color($certificateTemplate->text_color);
            });
            //return $img->response('png');

            $path = getcwd().'/bin/' . $user->username . '/certificates';

            if (!is_dir($path)) {
                mkdir($path);
            }

            $file_path = $path . '/' . $quiz->content->title . '(' . $quiz->name . ').jpg';
            if (is_file($file_path)) {
                $file_path = $path . '/' . $quiz->content->title . '(' . $quiz->name . '-' . $result->user_grade . ').jpg';
            }

            $img->save($file_path);

            $certificate = Certificate::where('quiz_id', $quiz->id)
                ->where('student_id', $user->id)
                ->where('quiz_result_id', $result->id)
                ->first();

            $data = [
                'quiz_id' => $quiz->id,
                'student_id' => $user->id,
                'quiz_result_id' => $result->id,
                'user_grade' => $result->user_grade,
                'file' => $file_path,
                'created_at' => time()
            ];

            if (!empty($certificate)) {
                $certificate->update($data);
            } else {
                Certificate::create($data);
            }

            if (file_exists($file_path)) {
                return response()->download($file_path);
            }
        }


        abort(404);
    }

    public function QuizzesQuestionsEdit(Request $request, $question_id)
    {
        $user = auth()->user();
        $question = QuizzesQuestion::where('id', $question_id)
            ->where('user_id', $user->id)
            ->first();
        $html = '';
        $status = false;

        if (!empty($question)) {
            $quiz = Quiz::find($question->quiz_id);
            if (!empty($quiz)) {
                $status = true;
                $data = [
                    'quiz' => $quiz,
                    'question_edit' => $question
                ];

                if ($question->type == 'multiple') {
                    $html = (string)\View::make(getTemplate() . '.user.quizzes.multiple_question_form', $data);
                } else {
                    $html = (string)\View::make(getTemplate() . '.user.quizzes.descriptive_question_form', $data);
                }
            }
        }

        return response()->json([
            'status' => $status,
            'html' => $html
        ], 200);
    }

    public function QuizzesQuestionsUpdate(Request $request, $question_id)
    {
        $user = auth()->user();
        $question = QuizzesQuestion::where('id', $question_id)
            ->where('user_id', $user->id)
            ->first();

        if (!empty($question)) {
            $quiz = Quiz::find($question->quiz_id);
            if (!empty($quiz)) {
                $rules = [
                    'title' => 'required',
                    'grade' => 'required',
                ];
                $this->validate($request, $rules);
                $data = $request->except(['_token']);

                $question->update([
                    'title' => $data['title'],
                    'grade' => $data['grade'],
                    'updated_at' => time(),
                ]);

                QuizzesQuestionsAnswer::where('user_id', $user->id)
                    ->where('question_id', $question->id)
                    ->delete();

                if (!empty($data['answers']) and count($data['answers'])) {
                    foreach ($data['answers'] as $answer) {
                        QuizzesQuestionsAnswer::create([
                            'user_id' => $user->id,
                            'question_id' => $question->id,
                            'title' => $answer['title'],
                            'image' => $answer['image'],
                            'correct' => $answer['correct'],
                            'created_at' => time(),
                        ]);
                    }
                }

                return back()->with('msg', trans('main.question_create_msg'))->with('type', 'success');
            }
        }

        abort(404);
    }

    public function QuizzesQuestionsDelete($question_id)
    {
        $user = auth()->user();
        $question = QuizzesQuestion::where('id', $question_id)
            ->where('user_id', $user->id)
            ->first();

        if (!empty($question)) {
            $question->delete();
            return back()->with('msg', trans('main.question_delete_msg'))->with('type', 'success');
        }

        abort(404);
    }

    public function CertificatesLists()
    {
        $user = auth()->user();
        $certificates = QuizResult::where('student_id', $user->id)
            ->where('status', 'pass')
            ->with(['quiz' => function ($query) {
                $query->with(['content']);
            }])
            ->get();

        $data = [
            'certificates' => $certificates,
        ];
        return view(getTemplate() . '.user.certificates.lists', $data);
    }


    ## Video Live ##
    public function videoLiveList(){
        $user = auth()->user();
        $courses = Content::where('mode','publish')->where('user_id', $user->id)->where(function ($w){
            $w->where('type','webinar')->orWhere('type','course+webinar');
        })->get();
        $list = MeetingDate::with(['content'])->where('user_id', $user->id)->paginate(20);
        return view('web.default.user.meeting.list',[
            'courses'   => $courses,
            'list'      => $list
        ]);
    }
    public function videoLiveNewStore(Request $request){
        $user = auth()->user();
        $Content = Content::where('user_id', $user->id)->find($request->content_id);
        if (!$Content)
            return back()->with('msg', trans('main.access_denied_content'));

        $timeStart  = strtotime($request->date.' '.$request->time);
        $timeEnd    = $timeStart + ($request->duration * 3600);
        $request->request->add([
            'user_id'   => $user->id,
            'time_start'=> $timeStart,
            'time_end'  => $timeEnd
        ]);
        MeetingDate::create($request->all());

        return back();
    }
    public function videoLiveEditStore($id, Request $request){
        $user = auth()->user();
        $Content = Content::where('user_id', $user->id)->find($request->content_id);
        if (!$Content)
            return back()->with('msg', trans('main.access_denied_content'));

        $timeStart  = strtotime($request->date.' '.$request->time);
        $timeEnd    = $timeStart + ($request->duration * 3600);
        $request->request->add([
            'user_id'   => $user->id,
            'time_start'=> $timeStart,
            'time_end'  => $timeEnd
        ]);
        MeetingDate::find($id)->update($request->all());
        return back();
    }
    public function videoLiveEdit($id){
        $user = auth()->user();
        $courses = Content::where('mode','publish')->where('user_id', $user->id)->where(function ($w){
            $w->where('type','webinar')->orWhere('type','course+webinar');
        })->get();
        $list = MeetingDate::with(['content'])->where('user_id', $user->id)->paginate(20);
        $edit = MeetingDate::where('user_id', $user->id)->find($id);
        return view('web.default.user.meeting.list',[
            'courses'   => $courses,
            'list'      => $list,
            'edit'      => $edit
        ]);
    }
    public function videoLiveUsers($id){
        $user = auth()->user();
        $course = Content::where('user_id', $user->id)->find($id);
        if(!$course)
            return back();

        $list = Sell::with(['buyer'])->where('content_id', $id);

        return view('web.default.user.meeting.users',['list'=>$list->paginate(30)]);
    }
    public function videoLiveUrlStore($id, Request $request){
        $user = auth()->user();
        MeetingDate::where('user_id', $user->id)->find($id)->update($request->all());
        return back()->with('msg', trans('main.successful'));

    }

    #### Controllers added to meet Tzenik needs ####

    ###########################
    #### Forum Controllers ####
    ###########################

    public function forum_posts(){
        $user = auth()->user();
        $id = $user->id;
        $category = ForumCategory::where('published', 'true')->where('type', 'public')->withCount('posts')->get();

        $private_categories = ForumCategory::where('published', 'true')->where('type', 'private')->get();
        $list_private_categories = array();

        foreach($private_categories as $private){
            $user_purchase = Sell::where('buyer_id', $user->id)->where('content_id', $private->product_id)->get();
            $content_vendor = Content::where('user_id', $user->id)->where('id', $private->product_id)->get();
            if(!$user_purchase->isEmpty() || !$content_vendor->isEmpty()){
                array_push($list_private_categories, array('id' => $private->id, 'title' => $private->title, 'desc' => $private->desc));
            }
        }

        return view('web.default.user.forum.list',array('lists'=>$category, 'user_id' =>$id, 'private' => $list_private_categories));
    }

    public function forum_postread($id)
    {
        $post = Forum::with(array('user','category','comments'=>function($query){
           $query->where('parent',0)->where('mode','publish')->with(array('childs'=>function($q){
               $q->where('mode','publish');
           }));
        }))->where('mode','publish')->find($id);
        return view('web.default.user.forum.post',['post'=>$post]);
    }

    public function forum_postCategory($id){

        $user = auth()->user();

        $category = ForumCategory::find($id);

        if($category->type == 'private'){
            $sell = Sell::where('content_id', $category->product_id)->where('buyer_id', $user->id)->get();
            $content_vendor = Content::where('user_id', $user->id)->where('id', $category->product_id)->get();
            if((!$sell->isEmpty() || !$content_vendor->isEmpty()) && $category->published == 'true'){
                $postList = Forum::with('comments', 'user')->where('category_id', $id)->where('mode', 'publish')->orderBy('id', 'DESC')->get();
                return view('web.default.user.forum.listbycategory', array('posts' => $postList));
            }else{
                return view(getTemplate() . '.view.error.403');
            }
        }else{
            $postList = Forum::with('comments', 'user')->where('category_id', $id)->where('mode', 'publish')->orderBy('id', 'DESC')->get();
            return view('web.default.user.forum.listbycategory', array('posts' => $postList));
        }
    }

    public function forum_newPost(){

        $user = auth()->user();

        $category = ForumCategory::where('published', 'true')->where('type', 'public')->get();

        $private_categories = ForumCategory::where('published', 'true')->where('type', 'private')->get();
        $list_private_categories = array();

        foreach($private_categories as $private){
            $user_purchase = Sell::where('buyer_id', $user->id)->where('content_id', $private->product_id)->get();
            $content_vendor = Content::where('user_id', $user->id)->where('id', $private->product_id)->get();
            if(!$user_purchase->isEmpty() || !$content_vendor->isEmpty()){
                array_push($list_private_categories, array('id' => $private->id, 'title' => $private->title, 'desc' => $private->desc));
            }
        }

        return view('web.default.user.forum.new',['category'=>$category, 'private' => $list_private_categories]);
    }
    public function forum_postDelete($id)
    {
        Forum::find($id)->delete();
        return back();
    }
    public function forum_store(Request $request){
        $user = auth()->user();
        $data = $request->except('_token');
        $data['user_id'] = $user->id;
        if($request->id){
            $data['update_at'] = time();
            if(isset($request->comment))
                $data['comment'] = 'enable';
            else
                $data['comment'] = 'disable';
            $post = Forum::where('id',$data['id'])->update($data);
            return back();
        }else{
            $data['create_at'] = time();
            if(isset($request->comment))
                $data['comment'] = 'enable';
            else
                $data['comment'] = 'disable';
            $post = Forum::create($data);
            return redirect('/user/forum');
        }

        $post_category = ForumCategory::find($post->category_id);
        if($post_category->product_id){
            $product = Content::find($post_category->product_id);
            $owner_id = $product->user_id;

            $owner = User::find($owner_id);

            sendMail([
                'template'=>get_option('user_register_wellcome_email'),
                'recipent'=>[$owner->email]
            ]);
        }
    }
    public function forum_editPost($id){
        $category = ForumCategory::all();
        $item = Forum::find($id);
        return view('admin.Forum.edit',['category'=>$category,'item'=>$item]);
    }


    public function forum_category()
    {
        $list = ForumCategory::withCount('posts')->get();
        return view('admin.forum.categroy',array('lists'=>$list));
    }
    public function forum_categoryEdit($id)
    {
        $list = ForumCategory::all();
        $item = ForumCategory::find($id);
        return view('admin.Forum.categroyedit',array('lists'=>$list,'item'=>$item));
    }
    public function forum_categoryStore(Request $request)
    {

        if($request->edit != '') {
            $category = ForumCategory::find($request->edit);
            $category->title = $request->title;
            $category->save();
        }
        else {
            $category = new ForumCategory;
            $category->title = $request->title;
            $category->save();
        }
        return back();
    }
    public function forum_categoryDelete($id)
    {
        ForumCategory::find($id)->delete();
        return back();
    }


    public function forum_comments()
    {
        $comments = ForumComments::with('user','post')->orderBy('id','DESC')->get();
        return view('admin.Forum.comments',['comments'=>$comments]);
    }
    public function forum_commentDelete($id)
    {
        ForumComments::find($id)->delete();
        return back();
    }
    public function forum_commentEdit($id)
    {
        $item = ForumComments::find($id);
        return view('admin.Forum.commentedit',['item'=>$item]);
    }
    public function forum_commentStore(Request $request)
    {
        $user = auth()->user();
        if(!empty($user)){
            $data = $request->except('_token');
            $data['user_id'] = $user->id;
            $data['mode'] = 'publish';
            $data['create_at'] = time();
            $data['name'] = $user->name;
            ForumComments::insert($data);
        }
        return back();
    }
    public function forum_commentView($action,$id)
    {
        $comment = ForumComments::find($id);
        $comment->mode = $action;
        $comment->save();
        return back();
    }
    public function forum_commentReply($id){
        $item = ForumComments::find($id);
        return view('admin.Forum.reply',['item'=>$item]);
    }
    public function forum_commentReplyStore(Request $request){
        global $admin;
        $comment = ForumComments::create([
            'comment'=>$request->comment,
            'user_id'=>$admin['id'],
            'create_at'=>time(),
            'name'=>$admin['name'],
            'post_id'=>$request->post_id,
            'parent'=>$request->parent,
            'mode'=>'publish'
        ]);
        return redirect('admin/Forum/comment/edit/'.$comment->id);
    }
    
    ##################
    ###### Chat ######
    ##################

    public function chat_Index()
    {
        $user = auth()->user();
        $result = [];
        $id = $user->id;
        //$chats = Chat_Chats::with('users_in_chat')->orderBy('id', 'DESC')->get();
        $chats = Chat_Chats::leftjoin('chat_users_in_chat', 'chat_chats.id', '=', 'chat_users_in_chat.chat_id')->where('chat_users_in_chat.user_id', $id)->select('chat_chats.id', 'chat_chats.name', 'chat_chats.published')->orderBy('chat_chats.id', 'DESC')->get();
        /*foreach($chats as $chat){
            $result[$chat] = $chat['id'];
            $result[$chat]['name'] = $chat['name'];
        }*/
        //return $result;
        return $chats;
        //return view(getTemplate() . '.user.chat.index', ['chats' => $chats]);
    }
    public function chat_getMessages($chat_id){
        $user = auth()->user();
        $id = $user->id;
        $name = $user->name;
        $chats = Chat_Chats::leftjoin('chat_users_in_chat', 'chat_chats.id', '=', 'chat_users_in_chat.chat_id')->where('chat_users_in_chat.user_id', $id)->select('chat_chats.id', 'chat_chats.name')->orderBy('chat_chats.id', 'DESC')->get();
        //$messages = Chat_Messages::with('message_owner')->where('chat_id', $chat_id)->orderBy('id', 'DESC')->get();
        $messages = Chat_Messages::join('users', 'users.id', '=', 'chat_messages.sender')->select('chat_messages.message', 'chat_messages.id', 'users.name')->where('chat_messages.chat_id', $chat_id)->orderBy('chat_messages.id', 'ASC')->get();
        //return view(getTemplate() . '.user.chat.chat', ['chats' => $chats, 'messages' => $messages, 'this_chat' => $chat_id, 'this_user' => $name]);
        return $messages;
    }
    public function chat_sendMessage($chat_id, Request $request){
        $user = auth()->user();
        $data = $request->except('_token');
        $data['sender'] = $user->id;
        $data['chat_id'] = $chat_id;
        //$message = $data['message'];
        //$redis = LRedis::connection();
        //$redis->publish('messageData', ['message' => $message, 'chat_id' => $chat_id, 'sender' => $user->id]);
        $message_id = Chat_Messages::insertGetId($data);
        return $message_id;
        
    }
    public function chat_getOwner($chat_id){
        $chat_owner = Chat_Chats::where('id', $chat_id)->value('creator');
        return $chat_owner;
    }

    public function chat_getUsers($chat_id){
        $chat_users = Chat_UsersInChat::leftjoin('users', 'users.id', '=', 'chat_users_in_chat.user_id')->select('users.id', 'users.name')->where('chat_users_in_chat.chat_id', $chat_id)->orderBy('chat_users_in_chat.id', 'ASC')->get();
        return $chat_users;
    }

    public function chat_deleteMessage($message_id){
        Chat_Messages::find($message_id)->delete();
        return true;
    }

    public function chat_deleteUser($user_id, $chat_id){
        Chat_UsersInChat::where('chat_id', $chat_id)->where('user_id', $user_id)->delete();
        return true;
    }

    ##################
    ##### Vendor #####
    ##################

    public function vendor(){
        return view('web.default.user.vendor.content.main');
    }

    public function vendorcontentLists(Request $request){
        $user = auth()->user();

        $fdate = strtotime($request->get('fdate', null)) + 12600;
        $ldate = strtotime($request->get('ldate', null)) + 12600;

        $users = User::all();
        $category = ContentCategory::get();
        $lists = Content::with(['category', 'user', 'metas' => function ($qm) {
            $qm->get()->pluck('option', 'value');
        }, 'transactions' => function ($q) {
            $q->where('mode', 'deliver');
        }])->withCount('sells', 'partsactive')->where(function ($w) {
            
        })->where('user_id', $user->id);


        if ($fdate > 12601)
            $lists->where('created_at', '>', $fdate);
        if ($ldate > 12601)
            $lists->where('created_at', '<', $ldate);
        if ($request->get('user', null) !== null)
            $lists->where('user_id', $request->get('user', null));
        if ($request->get('cat', null) !== null)
            $lists->where('category_id', $request->get('cat', null));
        if ($request->get('id', null) !== null)
            $lists->where('id', $request->get('id', null));
        if ($request->get('title', null) !== null)
            $lists->where('title', 'like', '%' . $request->get('title', null) . '%');


        if ($request->get('order', null) != null) {
            switch ($request->get('order', null)) {
                case 'sella':
                    $lists->orderBy('sells_count');
                    break;
                case 'selld':
                    $lists->orderBy('sells_count', 'DESC');
                    break;
                case 'viewa':
                    $lists->orderBy('view');
                    break;
                case 'viewd':
                    $lists->orderBy('view', 'DESC');
                    break;
                case 'datea':
                    $lists->orderBy('id');
                    break;

            }
        } else
            $lists->orderBy('id', 'DESC');


        if ($request->get('order', null) != null) {
            switch ($request->get('order', null)) {
                case 'priced':
                    $lists = $lists->sortByDesc(function ($item) {
                        return $item->metas->where('option', 'price')->pluck('value');
                    });
                    break;
                case 'pricea':
                    $lists = $lists->sortBy(function ($item) {
                        return $item->metas->where('option', 'price')->pluck('value');
                    });
                    break;
                case 'suma':
                    $lists = $lists->sortBy(function ($item) {
                        return $item->transactions->sum('price');
                    });
                    break;
                case 'sumd':
                    $lists = $lists->sortByDesc(function ($item) {
                        return $item->transactions->sum('price');
                    });
                    break;
            }
        }

        $lists = $lists->paginate(10);

        $data = [
            'lists' => $lists,
            'users' => $users,
            'category' => $category
        ];

        return view('web.default.user.vendor.content.contentlist', $data);
    }

    public function vendorUinCPrivate(Request $request){
        $fdate = strtotime($request->get('fdate', null)) + 12600;
        $ldate = strtotime($request->get('ldate', null)) + 12600;

        $user = auth()->user();

        $fundal_category = Usercategories::where('title', 'Fundal')->orWhere('title', 'fundal')->get();

        $users = User::where('category_id', $fundal_category[0]->id)->get();
        $category = ContentCategory::get();
        $lists = Content::with(['category', 'user', 'metas' => function ($qm) {
            $qm->get()->pluck('option', 'value');
        }, 'transactions' => function ($q) {
            $q->where('mode', 'deliver');
        }])->withCount('sells', 'partsactive')->where(function ($w) {
            $w->where('mode', 'publish');
        })->where('content_type', 'Fundal')->where('user_id', $user->id);


        if ($fdate > 12601)
            $lists->where('created_at', '>', $fdate);
        if ($ldate > 12601)
            $lists->where('created_at', '<', $ldate);
        if ($request->get('user', null) !== null)
            $lists->where('user_id', $request->get('user', null));
        if ($request->get('cat', null) !== null)
            $lists->where('category_id', $request->get('cat', null));
        if ($request->get('id', null) !== null)
            $lists->where('id', $request->get('id', null));
        if ($request->get('title', null) !== null)
            $lists->where('title', 'like', '%' . $request->get('title', null) . '%');


        if ($request->get('order', null) != null) {
            switch ($request->get('order', null)) {
                case 'sella':
                    $lists->orderBy('sells_count');
                    break;
                case 'selld':
                    $lists->orderBy('sells_count', 'DESC');
                    break;
                case 'viewa':
                    $lists->orderBy('view');
                    break;
                case 'viewd':
                    $lists->orderBy('view', 'DESC');
                    break;
                case 'datea':
                    $lists->orderBy('id');
                    break;

            }
        } else
            $lists->orderBy('id', 'DESC');


        if ($request->get('order', null) != null) {
            switch ($request->get('order', null)) {
                case 'priced':
                    $lists = $lists->sortByDesc(function ($item) {
                        return $item->metas->where('option', 'price')->pluck('value');
                    });
                    break;
                case 'pricea':
                    $lists = $lists->sortBy(function ($item) {
                        return $item->metas->where('option', 'price')->pluck('value');
                    });
                    break;
                case 'suma':
                    $lists = $lists->sortBy(function ($item) {
                        return $item->transactions->sum('price');
                    });
                    break;
                case 'sumd':
                    $lists = $lists->sortByDesc(function ($item) {
                        return $item->transactions->sum('price');
                    });
                    break;
            }
        }

        $lists = $lists->get();

        $usuarios_cursos = array();

        foreach($lists as $item){

            $sell = Sell::where('content_id', $item->id)->where('user_id', $user->id)->get();
            if(!$sell->isEmpty()){
                foreach($sell as $venta){
                    array_push($usuarios_cursos, array($venta->content_id, $venta->buyer_id));   
                }
            }
        }

        $data = [
            'lists' => $lists,
            'users' => $users,
            'category' => $category,
            'asignados' => $usuarios_cursos
        ];

        return view('web.default.user.vendor.content.usuariosEnCursos', $data);
    }

    public function vendorProgresoAlumnosFundal(Request $request){
        $fdate = strtotime($request->get('fdate', null)) + 12600;
        $ldate = strtotime($request->get('ldate', null)) + 12600;

        $user = auth()->user();

        $fundal_category = Usercategories::where('title', 'Fundal')->orWhere('title', 'fundal')->get();

        $users = User::where('category_id', $fundal_category[0]->id)->get();
        $category = ContentCategory::get();
        $lists = Content::with(['category', 'user', 'metas' => function ($qm) {
            $qm->get()->pluck('option', 'value');
        }, 'transactions' => function ($q) {
            $q->where('mode', 'deliver');
        }])->withCount('sells', 'partsactive')->where(function ($w) {
            $w->where('mode', 'publish');
        })->where('content_type', 'Fundal')->where('user_id', $user->id);


        if ($fdate > 12601)
            $lists->where('created_at', '>', $fdate);
        if ($ldate > 12601)
            $lists->where('created_at', '<', $ldate);
        if ($request->get('user', null) !== null)
            $lists->where('user_id', $request->get('user', null));
        if ($request->get('cat', null) !== null)
            $lists->where('category_id', $request->get('cat', null));
        if ($request->get('id', null) !== null)
            $lists->where('id', $request->get('id', null));
        if ($request->get('title', null) !== null)
            $lists->where('title', 'like', '%' . $request->get('title', null) . '%');


        if ($request->get('order', null) != null) {
            switch ($request->get('order', null)) {
                case 'sella':
                    $lists->orderBy('sells_count');
                    break;
                case 'selld':
                    $lists->orderBy('sells_count', 'DESC');
                    break;
                case 'viewa':
                    $lists->orderBy('view');
                    break;
                case 'viewd':
                    $lists->orderBy('view', 'DESC');
                    break;
                case 'datea':
                    $lists->orderBy('id');
                    break;

            }
        } else
            $lists->orderBy('id', 'DESC');


        if ($request->get('order', null) != null) {
            switch ($request->get('order', null)) {
                case 'priced':
                    $lists = $lists->sortByDesc(function ($item) {
                        return $item->metas->where('option', 'price')->pluck('value');
                    });
                    break;
                case 'pricea':
                    $lists = $lists->sortBy(function ($item) {
                        return $item->metas->where('option', 'price')->pluck('value');
                    });
                    break;
                case 'suma':
                    $lists = $lists->sortBy(function ($item) {
                        return $item->transactions->sum('price');
                    });
                    break;
                case 'sumd':
                    $lists = $lists->sortByDesc(function ($item) {
                        return $item->transactions->sum('price');
                    });
                    break;
            }
        }

        $duration = 0;
        $duration_done = 0;

        //$lists = $lists->paginate(10);
        $lists = $lists->get();
        //return $lists;

        $usuarios_cursos = array();

        foreach($lists as $item){

            $sell = Sell::where('content_id', $item->id)->get();
            if(!$sell->isEmpty()){
                foreach($sell as $venta){
                    $duration = 0;
                    $duration_done = 0;
                    $parts = ContentPart::where('content_id', $item->id)->get();
                    if(!$parts->isEmpty()){
                        foreach($parts as $part){
                            $parts_done = ProgresoAlumno::where('content_id', $item->id)->where('part_id', $part->id)->where('user_id', $venta->buyer_id)->get();
                            if(!$parts_done->isEmpty()){
                                $duration_done = $duration_done + $part->duration;
                            }
                            $duration = $duration + $part->duration;
                        }
    
                        $progress = (100 * $duration_done) / $duration;
    
                        array_push($usuarios_cursos, array($venta->content_id, $venta->buyer_id, $duration_done, $duration, $progress)); 
                    }  
                }
            }
        }

        $data = [
            'lists' => $lists,
            'users' => $users,
            'category' => $category,
            'asignados' => $usuarios_cursos
        ];

        return view('web.default.user.vendor.content.progresoAlumnos', $data);
    }

    public function vendorforumposts(){

        $user = auth()->user();

        $content = Content::where('user_id', $user->id)->select('id')->get()->toArray();

        $categories = ForumCategory::whereIn('product_id', $content)->select('id')->get()->toArray();

        $postList = Forum::with('comments','user')->orderBy('id','DESC')->whereIn('category_id', $categories)->get();
        return view('web.default.user.vendor.content.forumlist',array('posts'=>$postList));
    }

    public function vendorforumeditPost($id){
        $user = auth()->user();

        $content = Content::where('user_id', $user->id)->select('id')->get()->toArray();

        $category = ForumCategory::whereIn('product_id', $content)->get();

        $item = Forum::find($id);
        return view('web.default.user.vendor.content.forumedit',['category'=>$category,'item'=>$item]);
    }

    public function vendorforumstore(Request $request){
        global $admin;
        //$request->request->add(['user_id'=>$admin['id']]);
        if($request->id){
            $request->request->add(['update_at'=>time()]);
            if(isset($request->comment))
                $request->request->set('comment','enable');
            else
                $request->request->set('comment','disable');
            Forum::where('id',$request->id)->update($request->except(['_token', 'files']));
            return back();
        }else{
            $request->request->add(['create_at'=>time()]);
            if(isset($request->comment))
                $request->request->set('comment','enable');
            else
                $request->request->set('comment','disable');
            $post = Forum::create($request->except(['_token', 'files']));
            return redirect('/user/vendor/forum/post/edit/'.$post->id);
        }
    }
    public function vendorforumcomments(Request $request){
        $user = auth()->user();

        $content = Content::where('user_id', $user->id)->select('id')->get()->toArray();

        $categories = ForumCategory::whereIn('product_id', $content)->select('id')->get()->toArray();

        $postList = Forum::with('comments','user')->orderBy('id','DESC')->whereIn('category_id', $categories)->get()->toArray();

        $comments = ForumComments::whereIn('post_id', $postList)->with('user','post')->orderBy('id','DESC')->get();
        return view('web.default.user.vendor.content.forumcomments',['comments'=>$comments]);
    }
    public function vendorforumpostDelete($id){
        $post = Forum::find($id);
        $post->delete();

        return back();
    }
    public function vendorforumcommentDelete($id){
        $comment = ForumComments::find($id);
        $comment->delete();

        return back();
    }

    public function vendorAsignarCurso(Request $request){
        $curso = $request->curso;
        $getCurso = Content::find($curso);

        foreach($request->usuarios as $usuario){
            Sell::insert([
                'user_id' => $getCurso->user_id,
                'buyer_id' => $usuario,
                'content_id' => $getCurso->id,
                'type' => 'download',
                'created_at' => time(),
                'mode' => 'pay',
                'transaction_id' => '0',
                'remain_time' => NULL
            ]);
        }
        return back();
    }
    public function vendorGetUsersPrivate($curso){

        $fundal_category = Usercategories::where('title', 'Fundal')->orWhere('title', 'fundal')->get();

        $userList = User::where('category_id', $fundal_category[0]->id)->get();

        $array_disponibles = array();

        foreach($userList as $usuario){
            $asignados = Sell::where('buyer_id', $usuario->id)->where('content_id', $curso)->get();
            if($asignados->isEmpty()){
                $array_curso = array($usuario->id, $usuario->name, $usuario->username);
                array_push($array_disponibles, $array_curso);
            }
        }
        echo json_encode($array_disponibles);
    }

    public function vendorGetModulos($curso){

        $parts = ContentPart::where('content_id', $curso)->orderBy('id', 'desc')->get()->toJson();

        echo $parts;
        
    }

    public function videoteca(Request $request, $id = null){
        $order = $request->get('order', null);
        $price = $request->get('price', null);
        $course = $request->get('course', null);
        $off = $request->get('off', null);
        if ($request->get('filter') != null) {
            $filters = array_unique($request->get('filter'));
        } else {
            $filters = null;
        }
        $q = $request->get('q', null);
        $post_sell = $request->get('post-sell', null);
        $support = $request->get('support', null);

        $Category = ContentCategory::with(array('filters' => function ($q) {
            $q->with('tags');
        }))->where('class', $id)->first();

        $content = Content::where('mode', 'publish')->where('content_type', 'Videoteca')->with(['metas', 'sells', 'discount', 'user'])->withCount('parts');
        if (!empty($Category)) {
            $content = $content->where('category_id', $Category->id);
        }

        if (isset($q) and $q != '') {
            $content->where('title', 'LIKE', '%' . $q . '%');
        }

        if (isset($post_sell) and $post_sell == 1) {
            $content->where('post', '1');
        }

        if (isset($support) and $support == 1) {
            $content->where('support', '1');
        }

        if (isset($order) and $order == 'old') {
            $content->orderBy('id');
        }

        if (isset($order) and $order == 'new') {
            $content->orderBy('id', 'DESC');
        }

        ## Set For Course
        switch ($course) {
            case 'one':
                $content->where('type', 'single');
                break;
            case 'multi':
                $content->where('type', 'course');
                break;
            default:
                break;
        }

        $content = $content->get()->toArray();

        foreach ($content as $index => $c) {
            $content[$index]['metas'] = arrayToList($c['metas'], 'option', 'value');
        }

        $data = [
            'category' => $Category,
            'contents' => $content,
            'order' => $order,
            'pricing' => $price,
            'course' => $course,
            'off' => $off,
            'filters' => $filters,
        ];

        if ($id != null)
            return view(getTemplate() . '.view.category.videoteca', $data);
        else
            return view(getTemplate() . '.view.category.videoteca', $data);
    }

    public function vendorTareas(){
        $user = auth()->user();

        $courses = Content::where('user_id', $user->id)->where('content_type', '!=', 'Videoteca')->orderBy('id', 'DESC')->select(['id', 'title'])->get();

        foreach($courses as $course){
            $homework = Homeworks::where('content_id', $course->id)->get();
            if(!$homework->isEmpty()){
                foreach($homework as $hmwrk){
                    $part = ContentPart::where('id', $hmwrk->part_id)->value('title');
                    $hmwrk->part = $part;
                }   
            }
            $course->homeworks = $homework;
        }

        return view('web.default.user.vendor.content.tareas', ['courses' => $courses]);
    }

    public function vendorVerTareas($course, $part){
        $homeworks = HomeworksUser::where('content_id', $course)->where('part_id', $part)->get();

        $course = Content::where('id', $course)->value('title');
        $title = Homeworks::where('part_id', $part)->value('title');
        $part = ContentPart::where('id', $part)->value('title');

        foreach($homeworks as $homework){
            $user = User::where('id', $homework->user_id)->value('name');
            $homework->route = url('/').$homework->route;
            $homework->user = $user;
        }

        return view('web.default.user.vendor.content.tareas_usuarios', ['homeworks' => $homeworks, 'content_title' => $course, 'part_title' => $part, 'title' => $title]);
    }

    public function vendorRecibirTarea($tarea){
        $homework = HomeworksUser::where('id', $tarea)->update(['viewed' => 'true']);

        return $tarea;
    }

    public function vendorGetPartes($curso){
        $partes = ContentPart::where('content_id', $curso)->select(['id', 'title'])->get()->toJson();

        return $partes;
    }

    public function vendorNuevaTarea(Request $request){
        Homeworks::insert([
            'content_id' => $request->curso,
            'part_id' => $request->modulo,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return back();
    }

    public function tareas(){
        $user = auth()->user();

        $purchases = Sell::where('buyer_id',$user->id)->select(['content_id'])->get();

        $purchases_array = $purchases->toArray();

        $courses = Content::whereIn('id', $purchases_array)->where('content_type', 'Fundal')->select(['id', 'title'])->get();

        //return $courses;

        foreach($courses as $course){
            $homework = Homeworks::where('content_id', $course->id)->get();
            $course->homeworks = $homework;
            foreach($homework as $hmwrk){
                $part = ContentPart::where('id', $hmwrk->part_id)->value('title');
                $hmwrk->part = $part;
            } 
        }

        return view(getTemplate() . '.user.dashboard.tareas', ['courses' => $courses]);
    }

    public function subirTarea(Request $request){
        $user = auth()->user();
        $image = $request->file('file');
        $course = $request->course;
        $part = $request->part;

        $extension = $image->getClientOriginalExtension();
        $name = $user->name.'-'.$course.'-'.$part.'-('.time().').'.$extension;

        $image->move(public_path().'/bin/tareas/'.$course.'/'.$user->name.'/'.$part, $name);

        HomeworksUser::insert([
            'user_id' => $user->id,
            'content_id' => $course,
            'part_id' => $part,
            'route' => '/bin/tareas/'.$course.'/'.$user->name.'/'.$part.'/'.$name,
        ]);

        return response()->json(['success' => $name]);
    }

    #### Here ends area of custom controllers to meet Tzenik needs ####
}
