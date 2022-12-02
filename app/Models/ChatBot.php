<?php

namespace App\Models;

class ChatBot
{
    // Receive Message
    public function processMessage($msg)
    {
        $index = 0;
        $list = ['hello'=>1,'hi'=>1,'bye'=>2,'how are you'=>3, 'what\'s up'=>6, 'lonely'=>4,'sad'=>4, 'not happy'=>4,'happy'=>5];
       
        foreach($list as $key=>$value){
            if( stripos($msg, $key)!==false ){
                $index = $value;
                break;
            }
        }
        $response = $this->randResponse($index);
        return $response; 
    }

    // Respond!
    public function randResponse( $index )
    {
        $list = [
            ['Hmmm','We\'re not reading char for char. Can you explain?','Now, what\'s up with that?','Care to explain?'],
            ['Hi!','Nice to read from you!', 'Kind of you to pass by. What\'s cooking?', 'Wazzup??'],
            ['Take on the day!','Safe travels!','Hope to read from you again!','Have a good day!'],
            ['I\'m better than ever.','I\'m doing great!','Happy to read from you!','Oh, nothing new--Just happy to be alive!','Inspired to read from you!'],
            ['Cheer up!','Get those blues, out of hues!','Things will get better. Chin up!'],
            ['Wow, really? That\'s awesome!', 'Cool, I\'m happy for you!', 'That\'s mad insane--Good for you!'],
            ['Having a great day, thanks for asking!','Hi! Right back at ya.','Happy to be alive, I hope you are as well!','Up? I\'m up in the clouds.']
        ];
        $respIndex = rand(0,count($list[$index])-1);
        return $list[$index][$respIndex];
    }
}
