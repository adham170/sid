<?php
date_default_timezone_set('Asia/Baghdad');
if(!file_exists('config.json')){
	$token = readline('Enter Token: ');
	$id = readline('Enter Id: ');
	file_put_contents('config.json', json_encode(['id'=>$id,'token'=>$token]));
	
} else {
		  $config = json_decode(file_get_contents('config.json'),1);
	$token = $config['token'];
	$id = $config['id'];
}

if(!file_exists('accounts.json')){
    file_put_contents('accounts.json',json_encode([]));
}
include 'index.php';
try {
	$callback = function ($update, $bot) {
		global $id;
		if($update != null){
		  $config = json_decode(file_get_contents('config.json'),1);
		  $config['filter'] = $config['filter'] != null ? $config['filter'] : 1;
      $accounts = json_decode(file_get_contents('accounts.json'),1);
			if(isset($update->message)){
				$message = $update->message;
				$chatId = $message->chat->id;
				$text = $message->text;
				if($chatId == $id){
					if($text == '/start'){
              $bot->sendphoto([ 'chat_id'=>$chatId,
                  'photo'=>"https://t.me/Nekro_Hunter/2",
                   'caption'=>'𝑤𝑒𝑙𝑐𝑜𝑚𝑒 𝑡ℎ𝑒 𝑡𝑜𝑜𝑙 𝑏𝑦 ࿇࿆(@XNekro)  🛃',
                  'reply_markup'=>json_encode([
                      'inline_keyboard'=>[
                          [['text'=>'𝑎𝑑𝑑 𝑎𝑐𝑐𝑜𝑢𝑛𝑡 𝑓𝑎𝑘𝑒 👨‍💻 ','callback_data'=>'login']],
                      ]
                  ])
              ]);   
    if($text == '/help'){
              $bot->sendvideo([ 'chat_id'=>$chatId,
              'video'=>"https://t.me/FOLLOW_NAFSEA/162",
              'caption'=>'طرق السحب',
                      'reply_markup'=>json_encode([
                      'inline_keyboard'=>[                       
                       [['text'=>"اضغط لمراسله المطور للابلاغ عن مشاكل ", 'url'=>"https://t.me/ssssess"]],
                       ]
                       ])
                       ]);
    
              $bot->sendvoice([ 'chat_id'=>$chatId,
                  'voice'=>"hhttps://t.me/FOLLOW_NAFSEA/160",
                           'caption'=>'بصمه تعليم سحب 🔰',
                ]);
                      $bot->sendvoice([ 'chat_id'=>$chatId,
                  'voice'=>"https://t.me/FOLLOW_NAFSEA/147",
              'caption'=>'بصمه تعليم سحب 2 💖',
             ]);
            
 }

          } elseif($text != null){
          	if($config['mode'] != null){
          		$mode = $config['mode'];
          		if($mode == 'addL'){
          			$ig = new ig(['file'=>'','account'=>['useragent'=>'Instagram 27.0.0.7.97 Android (23/6.0.1; 640dpi; 1440x2392; LGE/lge; RS988; h1; h1; en_US)']]);
          			list($user,$pass) = explode(':',$text);
          			list($headers,$body) = $ig->login($user,$pass);
          			// echo $body;
          			$body = json_decode($body);
          			if(isset($body->message)){
          				if($body->message == 'challenge_required'){
          					$bot->sendMessage([
          							'chat_id'=>$chatId,
          							'parse_mode'=>'markdown',
          							'text'=>"لقد تم رفض الحساب لانه محظور او انه يطلب مصادقه⚙️"
          					]);
          				} else {
          					$bot->sendMessage([
          							'chat_id'=>$chatId,
          							'parse_mode'=>'markdown',
          							'text'=>"كلمه السر او اليوزر خطأ🪓"
          					]);
          				}
          			} elseif(isset($body->logged_in_user)) {
          				$body = $body->logged_in_user;
          				preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $headers, $matches);
								  $CookieStr = "";
								  foreach($matches[1] as $item) {
								      $CookieStr .= $item."; ";
								  }
          				$account = ['cookies'=>$CookieStr,'useragent'=>'Instagram 27.0.0.7.97 Android (23/6.0.1; 640dpi; 1440x2392; LGE/lge; RS988; h1; h1; en_US)'];
          				
          				$accounts[$text] = $account;
          				file_put_contents('accounts.json', json_encode($accounts));
          				$mid = $config['mid'];
          				$bot->sendMessage([
          				      'parse_mode'=>'markdown',
          							'chat_id'=>$chatId,
          							'text'=>"𝒅𝒐𝒏𝒆 𝒂𝒅𝒅 𝒂𝒄𝒐𝒐𝒖𝒏𝒕 💖 ⩫💣.*\n _Username_ : [$user])(instagram.com/$user)\n_Account Name_ : _{$body->full_name}_",
												'reply_to_message_id'=>$mid		
          					]);
          				$keyboard = ['inline_keyboard'=>[
										[['text'=> "𝒂𝒅𝒅 𝒏𝒆𝒘 𝒂𝒄𝒄𝒐𝒖𝒏𝒕 ",'callback_data'=>'addL']]
									]];
		              foreach ($accounts as $account => $v) {
		                  $keyboard['inline_keyboard'][] = [['text'=>$account,'callback_data'=>'ddd'],['text'=>"تسجيل الخروج",'callback_data'=>'del&'.$account]];
		              }
		              $keyboard['inline_keyboard'][] = [['text'=>'H𝒐𝒎𝒆 ','callback_data'=>'back']];
		              $bot->editMessageText([
		                  'chat_id'=>$chatId,
		                  'message_id'=>$mid,
		                  'text'=>"اهلا عزيزي ✔️ في الاسفل هي حساباتك الوهميه المسجله في الاداة",
		                  'reply_markup'=>json_encode($keyboard)
		              ]);
		              $config['mode'] = null;
		              $config['mid'] = null;
		              file_put_contents('config.json', json_encode($config));
          			}
          		}  elseif($mode == 'selectFollowers'){
          		  if(is_numeric($text)){
          		    bot('sendMessage',[
          		        'chat_id'=>$chatId,
          		        'text'=>"تم التعديل.",
          		        'reply_to_message_id'=>$config['mid']
          		    ]);
          		    $config['filter'] = $text;
          		    $bot->editMessageText([
                      'chat_id'=>$chatId,
                      'message_id'=>$mid,
                      'text'=>"صفحه التحكم الخاصه بك عزيزي استمتع مع اسهل طريقه لسحب الحسابات و اقواها
لمراسه المطور - @XNekro",
                  'reply_markup'=>json_encode([
                      'inline_keyboard'=>[
                          [['text'=>'𝒂𝒅𝒅 𝒂𝒄𝒄𝒐𝒖𝒏𝒕  ','callback_data'=>'login']],
                          [['text'=>'𝑔𝑒𝑡 𝑢𝑠𝑒𝑟  ','callback_data'=>'grabber']],
                          [['text'=>'.𝘴𝘵𝘢𝘳𝘵 𝘤𝘩𝘦𝘤𝘬 ⚡ ⁦','callback_data'=>'run'],['text'=>'.𝑠𝑡𝑜𝑝 𝑐ℎ𝑒𝑐𝑘 🔰 ','callback_data'=>'stop']],
                          [['text'=>'THE 𝑐ℎ𝑒𝑐𝑘 𝑠𝑡𝑜𝑝 𝑜𝑟 𝑠𝑡𝑎𝑟𝑡','callback_data'=>'status']]
                      ]
                  ])
                  ]);
          		    $config['mode'] = null;
		              $config['mid'] = null;
		              file_put_contents('config.json', json_encode($config));
          		  } else {
          		    bot('sendMessage',[
          		        'chat_id'=>$chatId,
          		        'text'=>'- يرجى ارسال رقم فقط .'
          		    ]);
          		  }
          		} else {
          		  switch($config['mode']){
          		    case 'search': 
          		      $config['mode'] = null; 
          		      $config['words'] = $text;
          		      file_put_contents('config.json', json_encode($config));
          		      exec('screen -dmS gr php search.php');
          		      break;
          		      case 'followers': 
          		      $config['mode'] = null; 
          		      $config['words'] = $text;
          		      file_put_contents('config.json', json_encode($config));
          		      exec('screen -dmS gr php followers.php');
          		      break;
          		      case 'following': 
          		      $config['mode'] = null; 
          		      $config['words'] = $text;
          		      file_put_contents('config.json', json_encode($config));
          		      exec('screen -dmS gr php following.php');
          		      break;
          		      case 'hashtag': 
          		      $config['mode'] = null; 
          		      $config['words'] = $text;
          		      file_put_contents('config.json', json_encode($config));
          		      exec('screen -dmS gr php hashtag.php');
          		      break;
          		  }
          		}
          	}
          }
				} else {
					$bot->sendphoto([
							'chat_id'=>$chatId,
							'photo'=> "https://t.me/Nekro_Hunter/2",
							 'caption'=>'البوت مدفوع 💲 و ليس مجاني 👁‍🗨
لشراء نسخه مراسلةة المطور 👁‍🗨',
                  'reply_markup'=>json_encode([
                      'inline_keyboard'=>[
                          [['text'=>'▫️| 『 𓆰⌯Nekro 』','url'=>'t.me/XNekro']],
                          [['text'=>"▪️| 𓆰⌯CH⌯🇦🇪", 'url'=>"t.me/Nekro_Hunter"]],
                      ]
                  ])
              ]);   
				}
			} elseif(isset($update->callback_query)) {
          $chatId = $update->callback_query->message->chat->id;
          $mid = $update->callback_query->message->message_id;
          $data = $update->callback_query->data;
          echo $data;
          if($data == 'login'){
              
        		$keyboard = ['inline_keyboard'=>[
									[['text'=>"➕ أضافه حساب وهمي جديد",'callback_data'=>'addL']]
									]];
		              foreach ($accounts as $account => $v) {
		                  $keyboard['inline_keyboard'][] = [['text'=>$account,'callback_data'=>'ddd'],['text'=>"تسجيل الخروج",'callback_data'=>'del&'.$account]];
		              }
		              $keyboard['inline_keyboard'][] = [['text'=>'H𝒐𝒎𝒆 ','callback_data'=>'back']];
		              $bot->sendMessage([
		                  'chat_id'=>$chatId,
		                  'message_id'=>$mid,
		                   'text'=>"اهلا عزيزي ✔️ في الاسفل هي حساباتك الوهميه المسجله في الاداة",
		                  'reply_markup'=>json_encode($keyboard)
		              ]);
          } elseif($data == 'addL'){
          	
          	$config['mode'] = 'addL';
          	$config['mid'] = $mid;
          	file_put_contents('config.json', json_encode($config));
          	$bot->sendMessage([
          			'chat_id'=>$chatId,
          			'text'=>"  ارسل الحساب بهذا النمط `user:pass`",
          			'parse_mode'=>'markdown'
          	]);
          } elseif($data == 'grabber'){
            
            $for = $config['for'] != null ? $config['for'] : 'حدد الحساب';
            $count = count(explode("\n", file_get_contents($for)));
            $bot->editMessageText([
                'chat_id'=>$chatId,
                'message_id'=>$mid,
                'text'=>"Users collection page. \n - Users : $count \n - For Account : $for",
                'reply_markup'=>json_encode([
                    'inline_keyboard'=>[
                        [['text'=>'F𝒓𝒐𝒎 𝒔𝒆𝒂𝒓𝒄𝒉 🔎 ','callback_data'=>'search']],
                        [['text'=>'F𝒓𝒐𝒎 𝒉𝒂𝒔𝒉𝒕𝒂𝒈 #⃣','callback_data'=>'hashtag'],['text'=>'من الاكسبلور 💡','callback_data'=>'explore']],
                        [['text'=>'F𝒓𝒐𝒎 𝒇𝒐𝒍𝒍𝒐𝒘𝒆𝒓𝒔 👤','callback_data'=>'followers'],['text'=>"من المتابعهم 🗣",'callback_data'=>'following']],
                        [['text'=>"𝒇𝒐𝒓 𝒂𝒄𝒄𝒐𝒖𝒏𝒕 👉  : $for",'callback_data'=>'for']],
                        [['text'=>'𝒏𝒆𝒘 𝒍𝒊𝒔𝒕  📥','callback_data'=>'newList'],['text'=>'𝒍𝒊𝒔𝒕 𝒂𝒑𝒑𝒆𝒏𝒅  📤','callback_data'=>'append']],
                        [['text'=>'H𝒐𝒎𝒆 ✅','callback_data'=>'back']]
                    ]
                ])
            ]);
          } elseif($data == 'search'){
            $bot->sendMessage([
                'chat_id'=>$chatId,
                'text'=>"الان قم بأرسال الكلمه التريد البحث عليها و ايضا يمكنك من استخدام اكثر من كلمه عن طريق وضع فواصل بين الكلمات⚔️"
            ]);
            $config['mode'] = 'search';
            file_put_contents('config.json', json_encode($config));
          } elseif($data == 'followers'){
            $bot->sendMessage([
                'chat_id'=>$chatId,
                'text'=>"الان قم بأرسال اليوزر التريد سحب متابعيه و ايضا يمكنك من استخدام اكثر من يوزر عن طريق وضع فواصل بين اليوزرات 🔪"
            ]);
            $config['mode'] = 'followers';
            file_put_contents('config.json', json_encode($config));
          } elseif($data == 'following'){
            $bot->sendMessage([
                'chat_id'=>$chatId,
                'text'=>"الان قم بأرسال اليوزر التريد سحب الذي  متابعهم و ايضا يمكنك من استخدام اكثر من يوزر عن طريق وضع فواصل بين اليوزرات 🔪"
            ]);
            $config['mode'] = 'following';
            file_put_contents('config.json', json_encode($config));
          } elseif($data == 'hashtag'){
            $bot->sendMessage([
                'chat_id'=>$chatId,
                'text'=>"الان قم بأرسال الهاشتاك بدون علامه # يمكنك 🧿استخدام هاشتاك واحد فقط"
            ]);
            $config['mode'] = 'hashtag';
            file_put_contents('config.json', json_encode($config));
          } elseif($data == 'newList'){
            file_put_contents('a','new');
            $bot->answerCallbackQuery([
							'callback_query_id'=>$update->callback_query->id,
							'text'=>"تم اختيار 🚸 لستةة يوزرات جديده بنجاح",
							'show_alert'=>1
						]);
          } elseif($data == 'append'){ 
            file_put_contents('a', 'ap');
            $bot->answerCallbackQuery([
							'callback_query_id'=>$update->callback_query->id,
							'text'=>"تم اختيار 🚸 لستةة يوزرات سابقةة بنجاح",
							'show_alert'=>1
						]);
						
          } elseif($data == 'for'){
            if(!empty($accounts)){
            $keyboard = [];
             foreach ($accounts as $account => $v) {
                $keyboard['inline_keyboard'][] = [['text'=>$account,'callback_data'=>'forg&'.$account]];
              }
              $bot->editMessageText([
                  'chat_id'=>$chatId,
                  'message_id'=>$mid,
                  'text'=>"اختار الحساب",
                  'reply_markup'=>json_encode($keyboard)
              ]);
            } else {
              $bot->answerCallbackQuery([
							'callback_query_id'=>$update->callback_query->id,
							'text'=>"اضف حساب بالاول😑",
							'show_alert'=>1
						]);
            }
          } elseif($data == 'selectFollowers'){
            bot('sendMessage',[
                'chat_id'=>$chatId,
                'text'=>'قم بأرسال عدد متابعين .'  
            ]);
            $config['mode'] = 'selectFollowers';
          	$config['mid'] = $mid;
          	file_put_contents('config.json', json_encode($config));
          } elseif($data == 'run'){
            if(!empty($accounts)){
            $keyboard = [];
             foreach ($accounts as $account => $v) {
                $keyboard['inline_keyboard'][] = [['text'=>$account,'callback_data'=>'start&'.$account]];
              }
              $bot->editMessageText([
                  'chat_id'=>$chatId,
                  'message_id'=>$mid,
                  'text'=>"حدد حساب",
                  'reply_markup'=>json_encode($keyboard)
              ]);
            } else {
              $bot->answerCallbackQuery([
							'callback_query_id'=>$update->callback_query->id,
							'text'=>"قم بتسجيل حساب اولا 😑",
							'show_alert'=>1
						]);
            }
          }elseif($data == 'stop'){
            if(!empty($accounts)){
            $keyboard = [];
             foreach ($accounts as $account => $v) {
                $keyboard['inline_keyboard'][] = [['text'=>$account,'callback_data'=>'stop&'.$account]];
              }
              $bot->editMessageText([
                  'chat_id'=>$chatId,
                  'message_id'=>$mid,
                  'text'=>"اختار الحساب",
                  'reply_markup'=>json_encode($keyboard)
              ]);
            } else {
              $bot->answerCallbackQuery([
							'callback_query_id'=>$update->callback_query->id,
							'text'=>"قم بتسجيل حساب اولا 😑",
							'show_alert'=>1
						]);
            }
          }elseif($data == 'stopgr'){
            shell_exec('screen -S gr -X quit');
            $bot->answerCallbackQuery([
							'callback_query_id'=>$update->callback_query->id,
							'text'=>"تم الانتهاء من السحب",
						// 	'show_alert'=>1
						]);
						$for = $config['for'] != null ? $config['for'] : 'Select Account';
            $count = count(explode("\n", file_get_contents($for)));
						$bot->editMessageText([
                'chat_id'=>$chatId,
                'message_id'=>$mid,
                'text'=>"Users collection page. \n - Users : $count \n - For Account : $for",
                'reply_markup'=>json_encode([
                    'inline_keyboard'=>[
                        [['text'=>'F𝒓𝒐𝒎 𝒔𝒆𝒂𝒓𝒄𝒉 🔎 ','callback_data'=>'search']],
                        [['text'=>'F𝒓𝒐𝒎 𝒉𝒂𝒔𝒉𝒕𝒂𝒈 #⃣','callback_data'=>'hashtag'],['text'=>'من الاكسبلور 💡','callback_data'=>'explore']],
                        [['text'=>'F𝒓𝒐𝒎 𝒇𝒐𝒍𝒍𝒐𝒘𝒆𝒓𝒔 👤','callback_data'=>'followers'],['text'=>"من المتابعهم 🗣",'callback_data'=>'following']],
                        [['text'=>"𝒇𝒐𝒓 𝒂𝒄𝒄𝒐𝒖𝒏𝒕 👉  : $for",'callback_data'=>'for']],
                        [['text'=>'𝒏𝒆𝒘 𝒍𝒊𝒔𝒕  📥','callback_data'=>'newList'],['text'=>'𝒍𝒊𝒔𝒕 𝒂𝒑𝒑𝒆𝒏𝒅  📤','callback_data'=>'append']],
                        [['text'=>'H𝒐𝒎𝒆 ✅','callback_data'=>'back']]
                    ]
                ])
            ]);
          } elseif($data == 'explore'){
            exec('screen -dmS gr php explore.php');
          } elseif($data == 'status'){
					$status = '';
					foreach($accounts as $account => $ac){
						$c = explode(':', $account)[0];
						$x = exec('screen -S '.$c.' -Q select . ; echo $?');
						if($x == '0'){
				        $status .= "*$account* ~> _Working_\n";
				    } else {
				        $status .= "*$account* ~> _Stop_\n";
				    }
					}
					$bot->sendMessage([
							'chat_id'=>$chatId,
							'text'=>"حاله الحسابات : \n\n $status",
							'parse_mode'=>'markdown'
						]);
				} elseif($data == 'back'){
          	$bot->editMessageText([
                      'chat_id'=>$chatId,
                      'message_id'=>$mid,
                     'text'=> "𝒘𝒆𝒍𝒄𝒐𝒎𝒆 𝒃𝒂𝒄𝒌 💖 ⁦",
                  'reply_markup'=>json_encode([
                      'inline_keyboard'=>[
                          [['text'=>'𝒂𝒅𝒅 𝒂𝒄𝒄𝒐𝒖𝒏𝒕  ','callback_data'=>'login']],
                          [['text'=>'𝑔𝑒𝑡 𝑢𝑠𝑒𝑟  ','callback_data'=>'grabber']],
                          [['text'=>'.𝘴𝘵𝘢𝘳𝘵 𝘤𝘩𝘦𝘤𝘬 ⚡ ⁦','callback_data'=>'run'],['text'=>'.𝑠𝑡𝑜𝑝 𝑐ℎ𝑒𝑐𝑘 🔰 ','callback_data'=>'stop']],
                          [['text'=>'THE 𝑐ℎ𝑒𝑐𝑘 𝑠𝑡𝑜𝑝 𝑜𝑟 𝑠𝑡𝑎𝑟𝑡','callback_data'=>'status']]
                      ]
                  ])
                  ]);
          } else {
          	$data = explode('&',$data);
          	if($data[0] == 'del'){
          		
          		unset($accounts[$data[1]]);
          		file_put_contents('accounts.json', json_encode($accounts));
              $keyboard = ['inline_keyboard'=>[
							[['text'=>"➕ أضافه حساب وهمي جديد",'callback_data'=>'addL']]
									]];
		              foreach ($accounts as $account => $v) {
		                  $keyboard['inline_keyboard'][] = [['text'=>$account,'callback_data'=>'ddd'],['text'=>"تسجيل الخروج",'callback_data'=>'del&'.$account]];
		              }
		              $keyboard['inline_keyboard'][] = [['text'=>'H𝒐𝒎𝒆 ','callback_data'=>'back']];
		              $bot->editMessageText([
		                  'chat_id'=>$chatId,
		                  'message_id'=>$mid,
		                    'text'=>"اهلا عزيزي ✔️ في الاسفل هي حساباتك الوهميه المسجله في الاداة",
		                  'reply_markup'=>json_encode($keyboard)
		              ]);
          	} elseif($data[0] == 'forg'){
          	  $config['for'] = $data[1];
          	  file_put_contents('config.json',json_encode($config));
              $for = $config['for'] != null ? $config['for'] : 'Select';
              $count = count(explode("\n", file_get_contents($for)));
              $bot->editMessageText([
                'chat_id'=>$chatId,
                'message_id'=>$mid,
                'text'=>"Users collection page. \n - Users : $count \n - For Account : $for",
                'reply_markup'=>json_encode([
                    'inline_keyboard'=>[
                        [['text'=>'F𝒓𝒐𝒎 𝒔𝒆𝒂𝒓𝒄𝒉 🔎 ','callback_data'=>'search']],
                        [['text'=>'F𝒓𝒐𝒎 𝒉𝒂𝒔𝒉𝒕𝒂𝒈 #⃣','callback_data'=>'hashtag'],['text'=>'من الاكسبلور 💡','callback_data'=>'explore']],
                        [['text'=>'F𝒓𝒐𝒎 𝒇𝒐𝒍𝒍𝒐𝒘𝒆𝒓𝒔 👤','callback_data'=>'followers'],['text'=>"من المتابعهم 🗣",'callback_data'=>'following']],
                        [['text'=>"𝒇𝒐𝒓 𝒂𝒄𝒄𝒐𝒖𝒏𝒕 👉  : $for",'callback_data'=>'for']],
                        [['text'=>'𝒏𝒆𝒘 𝒍𝒊𝒔𝒕  📥','callback_data'=>'newList'],['text'=>'𝒍𝒊𝒔𝒕 𝒂𝒑𝒑𝒆𝒏𝒅  📤','callback_data'=>'append']],
                        [['text'=>'H𝒐𝒎𝒆 ✅','callback_data'=>'back']]
                    ]
                ])
            ]);
          	} elseif($data[0] == 'start'){
          	  file_put_contents('screen', $data[1]);
          	  $bot->editMessageText([
                      'chat_id'=>$chatId,
                      'message_id'=>$mid,
                       'text'=> "𝒘𝒆𝒍𝒄𝒐𝒎𝒆 𝒃𝒂𝒄𝒌 💖 ⁦",
                  'reply_markup'=>json_encode([
                      'inline_keyboard'=>[
                          [['text'=>'𝒂𝒅𝒅 𝒂𝒄𝒄𝒐𝒖𝒏𝒕  ','callback_data'=>'login']],
                          [['text'=>'𝑔𝑒𝑡 𝑢𝑠𝑒𝑟  ','callback_data'=>'grabber']],
                          [['text'=>'.𝘴𝘵𝘢𝘳𝘵 𝘤𝘩𝘦𝘤𝘬 ⚡ ⁦','callback_data'=>'run'],['text'=>'.𝑠𝑡𝑜𝑝 𝑐ℎ𝑒𝑐𝑘 🔰 ','callback_data'=>'stop']],
                          [['text'=>'THE 𝑐ℎ𝑒𝑐𝑘 𝑠𝑡𝑜𝑝 𝑜𝑟 𝑠𝑡𝑎𝑟𝑡','callback_data'=>'status']]
                      ]
                  ])
                  ]);
              exec('screen -dmS '.explode(':',$data[1])[0].' php start.php');
              $bot->sendMessage([
                'chat_id'=>$chatId,
                'text'=>"*بدء الصيد.*\n Account: `".explode(':',$data[1])[0].'`',
                'parse_mode'=>'markdown'
              ]);
          	} elseif($data[0] == 'stop'){
          	  $bot->editMessageText([
                      'chat_id'=>$chatId,
                      'message_id'=>$mid,
                      'text'=>"𝒘𝒆𝒍𝒄𝒐𝒎𝒆 𝒃𝒂𝒄𝒌 💖 ⁦",
                  'reply_markup'=>json_encode([
                      'inline_keyboard'=>[
                          [['text'=>'𝒂𝒅𝒅 𝒂𝒄𝒄𝒐𝒖𝒏𝒕  ','callback_data'=>'login']],
                          [['text'=>'𝑔𝑒𝑡 𝑢𝑠𝑒𝑟  ','callback_data'=>'grabber']],
                          [['text'=>'.𝘴𝘵𝘢𝘳𝘵 𝘤𝘩𝘦𝘤𝘬 ⚡ ⁦','callback_data'=>'run'],['text'=>'.𝑠𝑡𝑜𝑝 𝑐ℎ𝑒𝑐𝑘 🔰 ','callback_data'=>'stop']],
                          [['text'=>'THE 𝑐ℎ𝑒𝑐𝑘 𝑠𝑡𝑜𝑝 𝑜𝑟 𝑠𝑡𝑎𝑟𝑡','callback_data'=>'status']]
                      ]
                    ])
                  ]);
              exec('screen -S '.explode(':',$data[1])[0].' -X quit');
          	}
          }
			}
		}
	};
	$bot = new EzTG(array('throw_telegram_errors'=>false,'token' => $token, 'callback' => $callback));
} catch(Exception $e){
	echo $e->getMessage().PHP_EOL;
	sleep(1);
}