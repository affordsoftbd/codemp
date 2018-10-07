@extends('layouts.master')

@section('title', "খবর ||")

@section('content')

<!-- Grid row -->
  <div class="row">

    <!-- News -->
    <div class="col-lg-9 mb-4">

        <!-- Card -->
        <div class="card card-cascade wider reverse">

          <!-- Card image -->
          <div class="view view-cascade overlay">
            <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Slides/img%20(142).jpg" alt="Sample image">
            <a href="#!">
              <div class="mask rgba-white-slight"></div>
            </a>
          </div>

          <!-- Card content -->
          <div class="card-body card-body-cascade text-center">

            <!-- Title -->
            <h2 class="font-weight-bold"><a>Title of the news</a></h2>
            <a href="#!" class="red-text"><h6 class="font-weight-bold mb-3"><i class="fa fa-tag pr-2"></i>Adventure</h6></a>
            <!-- Data -->
            <p>26/08/2018</p>

          </div>
          <!-- Card content -->

        </div>
        <!-- Card -->

        <!-- Excerpt -->
        <div class="mt-5">

          <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa nemo enim ipsam voluptatem quia voluptas sit qui officia deserunt mollitia animi, id est laborum et dolorum fuga quidem rerum facilis est distinctio.
          </p>
          <p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae itaque earum rerum.</p>

        </div>

        <h4 class="font-weight-bold mt-5">মন্তব্য</h4><hr>

        <!-- Card -->
        <div class="card news-card mb-4">
          <!-- Heading-->
          <div class="card-body">
            <div class="content">
              <div class="right-side-meta">14 h</div>
              <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(17)-mini.jpg" class="rounded-circle profile-image-thumbnile avatar-img z-depth-1-half"><strong>Kate</strong>
            </div>
          </div>
          <hr>
          <!-- Card content -->
          <div class="card-body">
            <!-- Social meta-->
            <div class="social-meta">
              <p>Another great adventure! </p>
            </div>
          </div>
        </div>
        <!-- Card -->

        <form id="comment_form" class="login-form" method="post" action="">
            <div class="md-form">
                {!! Form::textarea('additional_details', null, array('class'=>'editor','name'=>'comment_text','id'=>'comment_text')) !!}
            </div>
            <div class="text-center my-4">
                {!! Form::button('পোস্ট', array('type' => 'submit', 'class' =>'btn btn-danger btn-sm')) !!}
            </div>
        </form>

      <!--Pagination-->
      <nav aria-label="pagination example">
          <ul class="pagination pg-blue">

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

    <!-- Navigate -->
    <div class="col-lg-3 mb-4">
      @include('news.sort')
    </div>

  </div>

@endsection


