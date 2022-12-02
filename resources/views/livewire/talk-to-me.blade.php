
<div>
    <style>
        .delay-100{
            animation-delay:0.1s;
        }
        .delay-200{
            animation-delay:0.2s;
        }
    </style>
    <div>
        <input id="msg" wire:model.defer="msg" class="border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none" placeholder="What's on your mind?">
        <button class="bg-gradient-to-r delay-000 from-pink-300 to-yellow-400 p-2  rounded-full justify-center items-center" onClick="sendMsg()">Send</button>
    </div>

    <table class="w-full text-sm text-left text-gray-500" id="myTable">
        <tbody id="tbody" wire:ignore>
            
        </tbody>
    </table>
    
    <script>
        let chat         = [];
        let senderColors = ['to-pink-500 from-yellow-400', 'to-blue-400 from-sky-100']
        var mTable       = document.getElementById("myTable");
        var curRow       = null;
        
        function sendMsg(){
            let msg = document.getElementById('msg').value;
            chat.push( {'msg':sanitizeHTML(msg),'sender':0} );
            refreshTranscript();
            setTimeout(() => { 
                @this.getResponse(); 
            },1000);
            
        }

        window.addEventListener('response-received', event => {
            chat.push({'msg':event.detail.response,'sender':1})
            var rowTable = mTable.getElementsByTagName('tbody')[0].insertRow(-1);
            var cell1 = rowTable.insertCell(0);
            cell1.innerHTML =  loadingHtml();
            setTimeout(() => {  refreshTranscript(); }, 2000);
            
        });

        function refreshTranscript(){
            document.getElementById("tbody").innerHTML = '';
            for(let row=0; row<chat.length; row++){
                curRow = mTable.getElementsByTagName('tbody')[0].insertRow(-1);
                var cell1 = curRow.insertCell(0);
                cell1.innerHTML =  '<div class="bg-gradient-to-r '+senderColors[chat[row]['sender']]+' h-10 rounded-lg flex items-center pl-5">'+chat[row]['msg']+'</div>';
            }
        }

        function loadingHtml(){
            return '<div class="flex flex-row my-3 justify-end">\
                    <div class="animate-bounce bg-gradient-to-r delay-000 from-pink-300 to-yellow-400 flex space-x-2 p-3 w-4 h-4 rounded-full justify-center items-center"></div>\
                    <div class="animate-bounce bg-gradient-to-r delay-100 from-yellow-400 to-yellow-100 flex space-x-2 p-3 w-4 h-4 rounded-full justify-center items-center"></div>\
                    <div class="animate-bounce bg-gradient-to-r delay-200 bg-white flex space-x-2 p-3 w-4 h-4 rounded-full justify-center items-center"></div>\
                </div>';
        }

        function sanitizeHTML(str) {
            return str.replace(/[^\w. ]/gi, function (c) {
                return '&#' + c.charCodeAt(0) + ';';
            });
        };
    </script>
</div>
