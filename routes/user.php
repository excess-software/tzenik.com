<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'user'], function () {

    Route::group(['middleware' => ['user', 'notification']], function () {

        Route::get('dashboard', 'UserController@dashboard');
        Route::post('security/change', 'UserController@passwordChange');
        Route::get('calendar', 'UserController@calendar');
        #################
        #### Profile ####
        #################
        Route::group(['prefix' => 'profile'], function () {
            Route::get('/', 'UserController@userProfile');
            Route::post('store', 'UserController@userProfileStore');
            Route::post('meta/store', 'UserController@userProfileMetaStore');
            Route::post('avatar', 'UserController@userAvatarChange');
            Route::post('image', 'UserController@userProfileImageChange');
        });

        #################
        ### Dashboard ###
        #################
        Route::group(['prefix' => 'dashboard'], function () {
            Route::get('all', 'UserController@allCourses');
            Route::get('inProcess', 'UserController@inProcessCourses');
            Route::get('finished', 'UserController@finishedCourses');
        });

        ###################
        #### Trip Mode ####
        ###################
        Route::group(['prefix' => 'trip'], function () {
            Route::get('deactive', 'UserController@tripModeDeActive');
            Route::post('active', 'UserController@tripModeActive');
        });
    
        #### Routes added to meet Tzenik needs ####

        ###################
        ###### Forum ######
        ###################
        Route::group(['prefix'=>'forum'], function () {
            Route::get('', 'UserController@forum_posts');
            Route::get('post/new', 'UserController@forum_newpost');
            Route::get('post/category', 'UserController@forum_categorys');
            Route::post('post/store', 'UserController@forum_store');
            Route::get('post/read/{id}', 'UserController@forum_postread');

            Route::get('post/category/{id}', 'UserController@forum_postcategory');

            Route::post('post/comment/store', 'UserController@forum_commentstore');
        }); 

        Route::group(['prefix'=>'vendor'], function () {

            Route::get('', 'UserController@vendor');
            
            #####################
            ### Vendor Forum  ###
            #####################
            Route::group(['prefix'=>'forum'], function () {
                Route::get('posts', 'UserController@vendorforumposts');
                Route::get('post/new', 'UserController@forumnewpost');
                Route::get('post/edit/{id}','UserController@vendorforumeditPost');
                Route::get('post/delete/{id}','UserController@vendorforumpostDelete');
                Route::post('post/store', 'UserController@vendorforumstore');
                
                Route::get('category', 'UserController@forumcategorys');
                Route::get('category/edit/{id}','UserController@forumcategoryEdit');
                Route::get('category/delete/{id}','UserController@forumcategoryDelete');
                Route::post('category/store','UserController@forumcategoryStore');
                Route::get('comments','UserController@vendorforumcomments');
                Route::get('comment/delete/{id}','UserController@vendorforumcommentDelete');
            });

            #######################
            #### Vendor Content ###
            #######################
            Route::group(['prefix' => 'content'], function () {

                Route::get('list', 'UserController@vendorcontentLists');
                Route::get('private/asignar', 'UserController@vendorUinCPrivate');
                Route::get('private/desasignar', 'UserController@desasignarPrivate');
                Route::get('private/progresoFundal', 'UserController@progresoAlumnosFundal');
                Route::post('asignar', 'UserController@asignarCurso');
                Route::post('desasignar', 'UserController@desasignarCurso');
                Route::get('private/getUsers/{curso}', 'UserController@getUsersPrivate');
                Route::get('private/unasign/getUsers/{curso}', 'UserController@getAsignedUsersPrivate');
                Route::get('waiting', 'UserController@contentWaitingList');
                Route::get('draft', 'UserController@contentDraftList');
                Route::get('user/{id}', 'UserController@contentUserContent');
                Route::get('edit/{id}', 'UserController@contentEdit');
                Route::get('delete/{id}', 'UserController@contentDelete');
                Route::post('store/{id}/{mode}', 'UserController@contentStore');
                Route::get('list/excel', 'UserController@contentListExcel');

            });

            ########################
            #### Vendor Quizzes ####
            ########################
            Route::group(['prefix' => 'quizzes'], function () {
                Route::get('', 'UserController@vendorQuizzesList');
                Route::get('newQuiz', 'UserController@newQuiz');
                Route::post('/store', 'UserController@QuizzesStore');
                Route::get('/edit/{quiz_id}', 'UserController@QuizzesEdit');
                Route::post('/update/{quiz_id}', 'UserController@QuizzesUpdate');
                Route::get('/delete/{quiz_id}', 'UserController@QuizzesDelete');
                Route::get('/{quiz_id}/questions', 'UserController@QuizzesQuestions');
                Route::post('/{quiz_id}/questions', 'UserController@QuizzesQuestionsStore');
                Route::get('/{quiz_id}/results', 'UserController@QuizzesResults');
                Route::post('/results/get_descriptive', 'UserController@QuizzesResultsDescriptive');
                Route::post('/results/reviewed', 'UserController@QuizzesResultsReviewed');
            });

        }); 

        ##################
        ###### Chat ######
        ##################
        Route::group(['prefix'=>'chat'], function () {
            Route::get('', 'UserController@chat_Index');
            Route::get('Chat/{id}', 'UserController@chat_getMessages');
            Route::post('send_Message/{chat_id}', 'UserController@chat_sendMessage');
            Route::get('get_Owner/{chat_id}', 'UserController@chat_getOwner');
            Route::get('get_Users/{chat_id}', 'UserController@chat_getUsers');
            Route::get('delete_Message/{message_id}', 'UserController@chat_deleteMessage');
            Route::get('delete_User/{user_id}/{chat_id}', 'UserController@chat_deleteUser');
        });

        #### Here ends area of custom routes to meet Tzenik needs ####

        #############
        #### Buy ####
        #############
        Route::group(['prefix' => 'video'], function () {

            Route::group(['prefix' => 'buy'], function () {
                Route::get('', 'UserController@userBuyLists');
                Route::get('print/{id}', 'UserController@userBuyPrint');
                Route::post('confirm/{id}', 'UserController@userBuyConfirm');
                Route::get('rate/{id}/{rate}', 'UserController@userBuyRateStore');
            });

            Route::group(['prefix' => 'subscribe'], function () {
                Route::get('', 'UserController@subscribeList');
            });

            Route::group(['prefix' => 'off'], function () {
                Route::get('', 'UserController@userDiscounts');
                Route::get('edit/{id}', 'UserController@userDiscountEdit');
                Route::post('store', 'UserController@userDiscountStore');
                Route::post('edit/store/{id}', 'UserController@userDiscountEditStore');
                Route::get('delete/{id}', 'UserController@userDiscountDelete');
            });

            Route::group(['prefix' => 'promotion'], function () {
                Route::get('', 'UserController@promotions');
                Route::get('buy/{id}', 'UserController@promotionBuy');
                Route::post('buy/pay', 'UserController@promotionPay');
                Route::any('buy/pay/verify', 'UserController@promotionVerify');
            });

            Route::group(['prefix' => 'record'], function () {
                Route::get('', 'UserController@records');
                Route::get('edit/{id}', 'UserController@recordEdit');
                Route::get('delete/{id}', 'UserController@recordDelete');
                Route::post('store', 'UserController@recordStore');
                Route::post('edit/store/{id}', 'UserController@recordUpdate');
            });

            Route::group(['prefix' => 'request'], function () {
                Route::get('/', 'UserController@requests');
                Route::post('store', 'UserController@requestStore');
                Route::get('edit/{id}', 'UserController@requestEdit');
                Route::post('edit/store/{id}', 'UserController@requestUpdate');
                Route::post('admit', 'UserController@requestAdmit');
                Route::get('delete/{id}', 'UserController@requestDelete');
            });

            ## Live ##
            Route::group(['prefix'=>'live'], function (){
               Route::get('','UserController@videoLiveList');
               Route::get('list','UserController@videoLiveList');
               Route::post('new/store','UserController@videoLiveNewStore');
               Route::post('edit/store/{id}','UserController@videoLiveEditStore');
               Route::post('url/store/{id}','UserController@videoLiveUrlStore');
               Route::get('edit/{id}','UserController@videoLiveEdit');
               Route::get('users/{id}','UserController@videoLiveUsers');
            });

        });

        ## Article Section
        Route::group(['prefix' => 'article'], function () {
            Route::get('', 'UserController@articles');
            Route::get('list', 'UserController@articles');
            Route::get('new', 'UserController@articleNew');
            Route::post('store', 'UserController@articleStore');
            Route::get('edit/{id}', 'UserController@articleEdit');
            Route::post('edit/store/{id}', 'UserController@articleUpdate');
            Route::get('delete/{id}', 'UserController@articleDelete');
        });

        #################
        #### Channel ####
        #################
        Route::group(['prefix' => 'channel'], function () {
            Route::get('', 'UserController@channelList');
            Route::get('new', 'UserController@channelNew');
            Route::post('store', 'UserController@channelStore');
            Route::get('delete/{id}', 'UserController@channelDelete');
            Route::get('edit/{id}', 'UserController@channelEdit');
            Route::post('edit/store/{id}', 'UserController@channelUpdate');

            ## Chanel Request Section
            Route::get('request/{id}', 'UserController@channelRequest');
            Route::post('request/store', 'UserController@channelRequestStore');

            ## Chanel Video Section
            Route::get('video/{id}', 'UserController@chanelVideo');
            Route::post('video/store/{id}', 'UserController@chanelVideoStore');
            Route::get('video/delete/{id}', 'UserController@chanelVideoDelete');
        });

        #################
        #### Content ####
        #################
        Route::group(['prefix' => 'content'], function () {
            Route::get('', 'UserController@contentList');
            Route::get('delete/{id}', 'UserController@contentDelete');
            Route::get('request/{id}', 'UserController@contentRequest');
            Route::get('draft/{id}', 'UserController@contentDraft');
            Route::get('new', 'UserController@contentNew');

            Route::get('new_course','UserController@contentNewCourse');
            Route::get('new_webinar','UserController@contentNewWebinar');
            Route::get('new_coaching','UserController@contentNewCoaching');
            Route::get('web_coach/edit/{id}', 'UserController@contentEditWeb_Coach');

            Route::post('new/store', 'UserController@contentStore');
            Route::get('edit/{id}', 'UserController@contentEdit');
            Route::post('edit/store/{id}', 'UserController@contentUpdate');
            Route::get('edit/store/request/{id}', 'UserController@contentUpdateRequest');
            Route::post('edit/meta/store/{id}', 'UserController@contentMetaStore');

            Route::get('part/list/{id}', 'UserController@contentPartList');
            Route::get('part/new/{id}', 'UserController@contentPartNew');
            Route::get('part/edit/{id}', 'UserController@contentPartEdit');
            Route::get('part/delete/{id}', 'UserController@contentPartDelete');
            Route::get('part/draft/{id}', 'UserController@contentPartDraft');
            Route::get('part/request/{id}', 'UserController@contentPartRequest');
            Route::post('part/store', 'UserController@contentPartStore');

            Route::post('web_coach/part/store','UserController@contentPartStoreWeb_Coach');
            Route::post('web_coach/part/edit/store/{id}', 'UserController@contentPartEditStoreWeb_Coach');

            Route::post('part/edit/store/{id}', 'UserController@contentPartUpdate');

            Route::get('part/json/{id}', 'UserController@contentPartsJson');

            ## Meeting ##
            Route::group(['prefix'=>'meeting'], function (){
               Route::any('delete/{id}','UserController@contentMeetingDelete');
               Route::post('new/store/{id}','UserController@contentMeetingNewStore');
               Route::any('action','UserController@contentMeetingAction');
               Route::any('{id}','UserController@contentMeetingItem');
            });
        });

        #################
        #### Tickets ####
        #################
        Route::group(['prefix' => 'ticket'], function () {
            Route::get('', 'UserController@tickets');
            Route::post('store', 'UserController@ticketStore');
            Route::get('reply/{id}', 'UserController@ticketReply');
            Route::post('reply/store', 'UserController@ticketReplyStore');
            Route::get('close/{id}', 'UserController@ticketClose');
            Route::get('comments', 'UserController@ticketComments');
            Route::get('notification', 'UserController@ticketNotifications');
            ## Support
            Route::group(['prefix' => 'support'], function () {
                Route::get('', 'UserController@ticketSupport');
                Route::get('json/{content}/{sender}', 'UserController@ticketSupportJson');
                Route::post('jsonStore', 'UserController@ticketSupportStore');
            });
        });

        ##############
        #### Sell ####
        ##############
        Route::group(['prefix' => 'balance'], function () {
            Route::get('sell/list', 'UserController@sellDownload');
            Route::get('', 'UserController@sellDownload');
            Route::get('sell/post', 'UserController@sellPost');
            Route::post('sell/post/setPostalCode', 'UserController@setPostalCode');
            Route::get('log', 'UserController@balanceLogs');
            Route::get('charge', 'UserController@balanceCharge');
            Route::post('charge/pay', 'UserController@balanceChargePay');
            Route::get('report', 'UserController@balanceReport');
        });

        ## Vimeo
        Route::group(['prefix' => 'vimeo'], function () {
            Route::any('download', 'UserController@vimeoDownload');
        });

        ## Update Notification Ajax
        Route::get('ajax/notification/{mode}/{notification_id}', function ($mode, $notification_id) {
            global $user;
            if (setNotification($user['id'], $mode, $notification_id) == 1)
                return 1;
            else
                return 0;
        });

        Route::get('become', 'UserController@becomeVendor');

        Route::group(['prefix' => 'laravel-filemanager'], function () {
            \UniSharp\LaravelFilemanager\Lfm::routes();
        });

        Route::group(['prefix' => 'quizzes'], function () {
            Route::get('/', 'UserController@QuizzesList');
            Route::get('newQuiz', 'UserController@newQuiz');
            Route::post('/store', 'UserController@QuizzesStore');
            Route::get('/edit/{quiz_id}', 'UserController@QuizzesEdit');
            Route::post('/update/{quiz_id}', 'UserController@QuizzesUpdate');
            Route::get('/delete/{quiz_id}', 'UserController@QuizzesDelete');
            Route::get('/{quiz_id}/questions', 'UserController@QuizzesQuestions');
            Route::post('/{quiz_id}/questions', 'UserController@QuizzesQuestionsStore');
            Route::get('/{quiz_id}/start', 'UserController@QuizzesStart');
            Route::post('/{quiz_id}/store_results', 'UserController@QuizzesStoreResult');
            Route::get('/results/{result_id}', 'UserController@StudentQuizzesResults');
            Route::get('/{quiz_id}/results', 'UserController@QuizzesResults');
            Route::post('/results/get_descriptive', 'UserController@QuizzesResultsDescriptive');
            Route::post('/results/reviewed', 'UserController@QuizzesResultsReviewed');
        });

        Route::group(['prefix' => 'questions'], function () {
            Route::get('/{question_id}/edit', 'UserController@QuizzesQuestionsEdit');
            Route::post('/{question_id}/update', 'UserController@QuizzesQuestionsUpdate');
            Route::get('/{question_id}/delete', 'UserController@QuizzesQuestionsDelete');
        });

        Route::group(['prefix' => 'certificates'], function () {
            Route::get('/', 'UserController@CertificatesLists');
            Route::get('/{result_id}/download', 'UserController@QuizzesDownloadCertificate');
        });
    });
});

Route::group(['middleware' => 'notification'], function () {
    Route::group(['prefix' => 'user'], function () {
        Route::get('/', 'UserController@dashboard');

        Route::get('active/{id}', 'UserController@userActive');
        Route::post('reset', 'UserController@forgetPassword');
        Route::get('reset/token/{token}', 'UserController@resetToken');

        Route::get('/sociliate/google', 'UserController@googleLogin');
        Route::get('/google/login', 'UserController@googleDoLogin');

        ## Register Steps ##
        Route::get('steps/one/{phone}', 'UserController@registerStepOne');
        Route::get('steps/two/{phone}/{code}', 'UserController@registerStepTwo');
        Route::get('steps/two/repeat/{phone}', 'UserController@registerStepTwoRepeat');
        Route::any('steps/three/{phone}/{code}', 'UserController@registerStepThree');
    });

    ### Profile Section ###
    Route::get('follow/{id}', 'UserController@userFollow');
    Route::get('unfollow/{id}', 'UserController@userUnFollow');

    Route::get('profile/{id}', 'UserController@userProfileView');
    Route::post('profile/request/store', 'UserController@profileRequestStore');

    Route::group(['prefix' => 'bank'], function () {

        Route::group(['prefix' => 'paypal'], function () {
            Route::get('pay/{id}/{type}', 'UserController@paypalPay');
        });

        Route::group(['prefix' => 'paytm'], function () {
            Route::get('pay/{id}/{type}', 'UserController@paytmPay');
        });

        Route::group(['prefix' => 'payu'], function () {
            Route::get('pay/{id}/{type}', 'UserController@payuPay');
        });

        Route::group(['prefix' => 'paystack'], function () {
            Route::get('pay/{id}/{type}', 'UserController@paystackPay');
        });

        Route::group(['prefix' => 'paycom'], function () {
            Route::get('pay/{id}', 'UserController@paycomPay');
        });

        Route::get('razorpay/pay/{id}/{type}','UserController@razorpayPay');

        Route::get('/credit/pay/{id}/{mode}', 'UserController@creditPay');
    });
});


