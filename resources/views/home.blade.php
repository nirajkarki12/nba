@extends('layouts.front')

@section('content')


<div class="row news-videos">
  <div class="col-md-6">
    <div class="embed-responsive embed-responsive-16by9" id="player"></div>
  </div>

  <div id="slider" class="carousel slide col-md-4" data-ride="carousel">
    <div class="carousel-inner">
      @foreach($notices as $key => $notice)
        <div class="carousel-item @if($key == 1) active @endif">
          <img class="d-block w-100" src="{{ $notice->image_full_path }}" alt="{{ $notice->title }}" style=" width:100%; height: 350px !important;">
          <div class="carousel-caption d-none d-md-block">
            <h5>{{ $notice->title }}</h5>
            <p>{{ $notice->description }}</p>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  <div class="col-md-2">
    <h3 class="heading">जन प्रतिनिधि</h3>
    <div class="text-center">
      <img src="images/mayor.jpg" class="img-fluid" width="80%">
      <div class="title">
        <strong>राम अयोध्या यादव</strong>
      </div>
      <div class="designation">
        <em>अध्यक्ष</em>
      </div>
    </div>

    <div class="text-center">
      <img src="images/upada.jpg" class="img-fluid" width="80%">
      <div class="title">
        <strong>रिना कुमारी यादव</strong>
      </div>
      <div class="designation">
        <em>उपाध्यक्ष</em>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-4">
    <h3 class="heading">नागरिक बडापत्र</h3>
    <ul id="marquee">
      @foreach($services as $service)
        <li>
          <a href="javascript:void()" id="{{ $service->id }}" class="service-detail">
            <span>{{ $loop->iteration }}</span>. {{ $service->title }}
          </a>
        </li>
      @endforeach
    </ul>
  </div>
</div>

<!-- Large modal -->
<div id="modalContent"></div>


<div class="news-scroll">
  <marquee behavior="scroll" direction="left" scrollamount="4" onmouseover="this.stop()" onmouseout="this.start()">
    जथाभावि फोहोर नफालौँ, नगर स्वच्छ, सफा र सुन्दर राखौँ ।, गाउँ पालिकालाई बुझाउनु पर्ने कर दस्तुर समयमानै बुझाई जरीबाना बाट बचौँ ।, सडक अवरोध हुनेगरी निर्माण सामाग्री नराखौँ ।, ढलमा अनावश्यक फोहोर नफालौँ, ढललाई बन्द हुन नदिऊँ ।, पाल्तु कुकुरहरु सडकमा नछोडौँ, घरमा नै बाँधेर राखी रेविज विरुद्धको खोप लगाऔँ । , सडक चोकमा होडिङ्गवोर्ड, साईनवोर्ड, व्यानर राख्दा गाउँपालिका सँग पूर्व स्वीकृत लिएर मात्र राखौँ । , उद्योग व्यवसाय संचालन गर्दा गाउँपालिकाबाट सिफारिस लिएर मात्र संचालन गरौँ । , व्यवसाय संचालन भएपछि गाउँपालिकामा आफ्नो व्यवसाय दर्ता गरि प्रमाण पत्र लिऔँ । , अखाद्य, मिसावटयूक्त खाद्य सामाग्रीहरुको विक्री वितरण तथा प्रयोग नगरौँ । , जन्म, मृत्यू, बसाईसराई, विवाह, सम्बन्धविच्छेद जस्ता घटना घटेको ३५ दिन भित्रै दर्ता गरि जरिवाना बाट बचौँ । , छतको पानि सडकमा सोझै नझारौँ ।, सडक अधिकार क्षेत्रको लागि घर अगाडि छोडिएको भागमा सेफ्टीट्याङ्की लगाएत कुनै पनि संरचना निर्माण नगरौँ ।, गाउँक्षेत्र भित्र जग्गा प्लानिङ्ग गर्दा गाउँपालिकाको पूर्व स्वीकृत लिऔँ । , घरनक्शा पास गरि ईजाजन पत्र लिएर मात्र निर्माण कार्य गरौँ । , गाउँपालिका क्षेत्रबाट निकृष्ट बालश्रम उन्मूलन कार्यमा सहयोग गरौँ । , बिष्णु गाउँपालिका क्षेत्रलाई खुला दिशा मुक्त बनाउने अभियानलाई सार्थकता दिन सहयोग पुर्याऔँ । , सुख्खा मौसममा आगलागिको डर बढी हुने भएकोले आगोजन्य सामग्रीको प्रयोगमा सावधानि अपनाऔँ ।
  </marquee>
</div>

@endsection

@section('scripts')
<script src="//www.youtube.com/iframe_api"></script>
<script type="text/javascript">

  function serviceDetail(id)
  {
    var modalContent = $('body').find('#modalContent');
    $.ajax({
      type:'post',
      url: '{!! route("service.detail") !!}',
      data: { id: id },
      success:function(data){
        modalContent.html(data);
        $('#myModal').modal();
      }
    });
  }

  var videoIDs = {!! $videos !!};
  var player, currentVideoId = 0;
  
  function getVideos()
  {
    $.ajax({
      type:'get',
      url: "{!! route('get.videos') !!}",
      success:function(data){
        videoIDs = data.videos;
      }
    });
  }

  function onYouTubeIframeAPIReady() {
      player = new YT.Player('player', {
        height: '350',
        width: '425',
        playerVars: {
          'autoplay': 1,
          'controls': 0, 
          'autohide': 0,
          'showinfo' : 0,
          'wmode': 'opaque',
          'rel': 0,
          'loop': 0
        },
        events: {
          'onReady': onPlayerReady,
          'onStateChange': onPlayerStateChange
        }
    });
  }

  function onPlayerReady(event) {
    event.target.loadVideoById(videoIDs[currentVideoId]);
  }

  function onPlayerStateChange(event) {
    if (event.data == YT.PlayerState.ENDED) {
      currentVideoId++;
      if (currentVideoId < videoIDs.length) {
          player.loadVideoById(videoIDs[currentVideoId]);
      }else {
        getVideos();
        currentVideoId = 0;
        player.loadVideoById(videoIDs[currentVideoId]);
      }
    }
  }

  $(document).ready(function() {
    $('.service-detail').click(function(e) {
      var id = this.id;
      serviceDetail(id);
    });
    $('.carousel').carousel({
      interval: 10000
    });

    $('body').find('div.staffs img').each(function(i, obj) {
      $(this).addClass('img-fluid staffs-img');
    });

    $("#marquee").lightSlider({
      item: 6,
      /*autoWidth: false,
      slideMove: 1, */// slidemove will be 1 if loop is true
      slideMargin: 0,

      mode: "slide",
      useCSS: true,
      cssEasing: 'ease', //'cubic-bezier(0.25, 0, 0.25, 1)',//
      easing: 'linear', //'for jquery animation',////

      speed: 400, //ms'
      auto: true,
      loop: true,
      slideEndAnimation: true,
      pause: 3000,

      keyPress: false,
      controls: false,
      prevHtml: '',
      nextHtml: '',

      rtl:false,
      adaptiveHeight:false,

      vertical:true,
      verticalHeight:230,
      vThumbWidth:100,

      thumbItem:10,
      pager: false,
      gallery: false,
      galleryMargin: 0,
      thumbMargin: 0,
      currentPagerPosition: 'middle',

      enableTouch:true,
      enableDrag:true,
      freeMove:true,
      swipeThreshold: 40,

      responsive : [],

    });
  });
</script>
@endsection


