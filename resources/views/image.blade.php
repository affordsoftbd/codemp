@extends('layouts.master')

@section('title', "অ্যালবাম মন্তব্যসমূহ || ")

@section('content')

<div class="row">
    <div class="col-xl-1 col-lg-2 col-md-2">
        <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(18)-mini.jpg" class="rounded-circle z-depth-1-half">
    </div>
    <div class="col-xl-11 col-lg-10 col-md-10">
        <h6 class="font-weight-bold">Gracie Monahan</h6>
        <small class="grey-text">Monday 20 August 2018, 09:50 AM</small>
    </div>
    <div class="col-xl-12 col-lg-12 col-md-12" align="center">
        <hr>
        <h4 class="font-weight-bold text-center">Album Name</h4>
        <div class="item my-4" id="aniimated-thumbnials">
            <ul id="content-slider" class="content-slider">
                <li>
                    <a href="http://sachinchoolur.github.io/lightslider/img/cS-8.jpg" data-sub-html="Focused client-server ability 1"> 
                    <img class="img-fluid" src="http://sachinchoolur.github.io/lightslider/img/cS-8.jpg" alt="Order Image ba5016238db98b54520a1294c88829b4 1">
                    </a>
                </li>
                <li>
                    <a href="http://sachinchoolur.github.io/lightslider/img/cS-9.jpg" data-sub-html="Focused client-server ability 2"> 
                    <img class="img-fluid" src="http://sachinchoolur.github.io/lightslider/img/cS-9.jpg" alt="Order Image f0ed63aaa83c0877b37a9d3651297d06 2">
                    </a>
                </li>
                <li>
                    <a href="http://sachinchoolur.github.io/lightslider/img/cS-10.jpg" data-sub-html="Focused client-server ability 3"> 
                    <img class="img-fluid" src="http://sachinchoolur.github.io/lightslider/img/cS-10.jpg" alt="Order Image 451ed4cefd0a22d2c38a2f59d8cf3507 3">
                    </a>
                </li>
                <li>
                    <a href="http://sachinchoolur.github.io/lightslider/img/cS-12.jpg" data-sub-html="Focused client-server ability 3"> 
                    <img class="img-fluid" src="http://sachinchoolur.github.io/lightslider/img/cS-12.jpg" alt="Order Image 451ed4cefd0a22d2c38a2f59d8cf3507 3">
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-xl-12 col-lg-12 col-md-12 my-5">
        <button type="button" class="btn btn-sm btn-fb"><i class="fa fa-facebook"></i></button>
        <button type="button" class="btn btn-sm btn-tw"><i class="fa fa-twitter"></i></button>
        <button type="button" class="btn btn-sm btn-gplus"><i class="fa fa-google-plus"></i></button>
    </div>
    <div class="col-xl-12 col-lg-12 col-md-12">
        <!--Pagination-->
        <nav aria-label="pagination example">
            <ul class="pagination pg-blue justify-content-center">

                <!--Arrow left-->
                <li class="page-item disabled">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>

                <li class="page-item active">
                    <a class="page-link" href="#">1 <span class="sr-only">(current)</span></a>
                </li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">4</a></li>
                <li class="page-item"><a class="page-link" href="#">5</a></li>

                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="col-xl-1 col-lg-2 col-md-2 my-3">
        <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(18)-mini.jpg" class="rounded-circle z-depth-1-half">
    </div>
    <div class="col-xl-11 col-lg-10 col-md-10 my-3">
        <div class="card border message_area border-light">
            <div class="card-body">
                <h6 class="font-weight-bold">Kaleigh Murazik</h6>
                <small class="grey-text">Monday 20 August 2018, 09:50 AM</small>
                <hr>
                Dolor tenetur quam et quasi architecto quas. Accusantium tempore dolore repellendus fuga cupiditate ut laboriosam. Adipisci voluptas reprehenderit rerum nihil. Voluptatem pariatur inventore et quidem qui.

                Molestiae quam consequuntur qui fuga enim. Et et vitae at totam laudantium. Rem autem cum explicabo quo voluptates et.

                Reiciendis eos occaecati mollitia dolorum quasi. Sed facilis in nihil laudantium. Quo ut quod commodi enim aperiam molestias.
            </div>
        </div>
    </div>
    <div class="col-xl-1 col-lg-2 col-md-2 my-3">
        <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(18)-mini.jpg" class="rounded-circle z-depth-1-half">
    </div>
    <div class="col-xl-11 col-lg-10 col-md-10 my-3">
        <div class="card border message_area border-light">
            <div class="card-body">
                <h6 class="font-weight-bold">Kaleigh Murazik</h6>
                <small class="grey-text">Monday 20 August 2018, 09:50 AM</small>
                <hr>
                Nihil facere enim consectetur nisi aut rerum. Amet ducimus nam quidem. Iure corporis et dolor deleniti perspiciatis et.

                Placeat unde dicta sit possimus excepturi quasi laudantium. Maiores rerum eos ut ipsum nobis. Ut laborum eaque qui praesentium totam id nostrum. Voluptatibus velit dolorem ut officiis. Rerum ut eligendi maiores a alias maxime possimus quia.
            </div>
        </div>
    </div>
    <div class="col-xl-12 col-lg-12 col-md-12 mt-5 text-center">
        <h6 class="font-weight-bold red-text">আপনার মন্তব্য পোস্ট করুন</h4>
    </div>
    <div class="col-xl-1 col-lg-2 col-md-2">
        <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(18)-mini.jpg" class="rounded-circle z-depth-1-half">
    </div>
    <div class="col-xl-11 col-lg-10 col-md-10">
        {!! Form::open() !!}    
            <div class="md-form">
                {!! Form::textarea('additional_details', null, array('class'=>'editor')) !!}
            </div>
            <div class="text-center my-4">
                {!! Form::button('পোস্ট', array('type' => 'submit', 'class' =>'btn btn-danger btn-sm')) !!}
            </div>
        {!! Form::close() !!}
        <div class="clearfix"></div>
    </div>

</div>

@endsection


