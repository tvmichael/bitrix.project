(function(window){
    if (window.JSCarouselElement)
        return;

    window.JSCarouselElement = function(arParams) {
        this.id = arParams.id;
        this.carouselInner = $('#'+ this.id + ' .carousel-inner')[0];
        this.videoList = arParams.video;
        this.player = null;
        this.isMobile = null;
        this.init();
        // console.log(this);
    };

    window.JSCarouselElement.prototype = {
        init: function () {
            var self = this;

            $(this.carouselInner).width( $(window).width() );
            this.innerWidthHeight( $(window).width(), $(window).height() );
            //this.imgResize();

            $(window).resize(function() {
                var w = $(window).width(),
                    h = $(window).height();
                self.innerWidthHeight(w, h);
                self.imgResize();
            });

            this.loadVideo(this.videoList);

            $('.carousel').carousel({
                interval: 10000,
            });

            $('#play1234567890').click(function(){
                console.log('play')
                $('.carousel').carousel('cycle');

            });
            $('#stop1234567890').click(function(){
                console.log('stop')
                $('.carousel').carousel('pause');
            });
            
            var self = this;
            $( document ).ready(function() {                
                self.imgResize();
            });

            this.isMobile = false;
            if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) 
                || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4)))
                this.isMobile = true;           
            if(this.isMobile){
                $(this.carouselInner).height(240);
            }
        },

        innerWidthHeight: function (wW, wH) 
        {
            var i,
                span = $('[data-target]');

            $(this.carouselInner).width(wW);

            if( wW < 800 || wH < 400)
            {
                $(this.carouselInner).height(240);                
                for (i=0; i<span.length; i++) span[i].style.width = '40px';
            }
            else 
            {
                $(this.carouselInner).height(450);
                for (i=0; i<span.length; i++) $(span[i]).width(83);                
            }
        },

        imgResize: function () {
            var cH = $(this.carouselInner).height(),
                cW = $(this.carouselInner).width();

            var activeImg,
                iNaturalW,
                iNaturalH,
                iW, iH,
                ratio,
                top, left;

            var img = $('img', this.carouselInner),
                n = img.length,
                i;

            for(i = 0; i < n;  i++){
                activeImg = img[i]; // $('.active img', this.carouselInner)[0],
                iNaturalW = activeImg.naturalWidth;
                iNaturalH = activeImg.naturalHeight;

                // scaled image
                ratio = cW / iNaturalW;
                iW = Math.round(cW);
                iH = Math.round(iNaturalH * ratio);

                if(cH > iH){
                    ratio = cH / iH;
                    iW = Math.round(iW * ratio);
                    iH = Math.round(iH * ratio);
                }
                $(activeImg).css("max-width",iW);
                $(activeImg).width(iW);
                $(activeImg).height(iH);

                // center image
                left = Math.round( (cW - iW) / 2);
                top = Math.round( (cH - iH) / 2);
                $(activeImg).css('left', left);
                $(activeImg).css('top', top);
            }
        },

        loadVideo: function (videoList) {
            var playerYT = Array();

            // 2. This code loads the IFrame Player API code asynchronously.            
            var tag = document.createElement('script');
            tag.src = "https://www.youtube.com/iframe_api";
            var firstScriptTag = document.getElementsByTagName('script')[0];
            firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

            window.onYouTubeIframeAPIReady = function () {
                for (var i in videoList) {
                    playerYT[i] = new YT.Player(videoList[i].id, {
                        height: '100%',
                        width: '100%',
                        videoId: videoList[i].videoId,
                        events: {
                            'onReady': onPlayerReady,
                            'onStateChange': onPlayerStateChange
                        },
                        playerVars: {
                            //'autoplay': 1,
                            'controls': 0,
                            'autohide': 0,
                            'showinfo' : 0,
                            //'wmode': 'opaque',
                            'rel': 0,
                            //'loop': 1
                            'fs' : 0
                        }
                    });
                }
            };
            function onPlayerStateChange(event) {
                if (event.data === YT.PlayerState.ENDED) {
                    event.target.playVideo();
                }
            }
            window.onPlayerReady = function(event) {
                event.target.mute();
                event.target.playVideo();
            };
            this.player = playerYT;
        }


    };
})(window);








