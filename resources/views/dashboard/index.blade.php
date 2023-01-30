@extends('layouts.dashboard')

@section('content')
<!-- / .main-navbar -->
<div class="main-content-container container-fluid px-4">
  <!-- Page Header -->
  <div class="page-header row no-gutters py-4">
    <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
      <span class="text-uppercase page-subtitle">Dashboard</span>
      <h3 class="page-title">Blog Overview</h3>
    </div>
  </div>
  <!-- End Page Header -->
  <!-- Small Stats Blocks -->
  <div class="row">
    <div class="col-lg col-md-4 col-sm-6 col-6 mb-4">
      <div class="stats-small stats-small--1 card card-small">
        <div class="card-body p-0 d-flex">
          <div class="d-flex flex-column m-auto">
            <div class="stats-small__data text-center">
              <span class="stats-small__label text-uppercase">Categories</span>
              <h6 class="stats-small__value count my-3">{{ count($categories) }}</h6>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg col-md-6 col-sm-6 col-6 mb-4">
      <div class="stats-small stats-small--1 card card-small">
        <div class="card-body p-0 d-flex">
          <div class="d-flex flex-column m-auto">
            <div class="stats-small__data text-center">
              <span class="stats-small__label text-uppercase">Posts</span>
              <h6 class="stats-small__value count my-3">{{ $totalposts }}</h6>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg col-md-4 col-sm-6 col-6 mb-4">
      <div class="stats-small stats-small--1 card card-small">
        <div class="card-body p-0 d-flex">
          <div class="d-flex flex-column m-auto">
            <div class="stats-small__data text-center">
              <span class="stats-small__label text-uppercase">My Posts</span>
              <h6 class="stats-small__value count my-3">{{ $mytotalposts }}</h6>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg col-md-6 col-sm-6 col-6 mb-4">
      <div class="stats-small stats-small--1 card card-small">
        <div class="card-body p-0 d-flex">
          <div class="d-flex flex-column m-auto">
            <div class="stats-small__data text-center">
              <span class="stats-small__label text-uppercase">Videos</span>
              <h6 class="stats-small__value count my-3">{{ $totalvideos }}</h6>
            </div>
          </div>
        </div>
      </div>
    </div>
    @if (Gate::allows('isAdmin') || Gate::allows('isManager'))
    <div class="col-lg col-md-4 col-sm-6 col-6 mb-4">
      <div class="stats-small stats-small--1 card card-small">
        <div class="card-body p-0 d-flex">
          <div class="d-flex flex-column m-auto">
            <div class="stats-small__data text-center">
              <span class="stats-small__label text-uppercase">Users</span>
              <h6 class="stats-small__value count my-3">{{ $totalusers }}</h6>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endif
  </div>


 <!-- End Small Stats Blocks -->
 <div class="row">
    <!-- Users Stats -->
   <div class="col-lg-8 col-md-12 col-sm-12 mb-4">
     <div class="card card-small">
       <div class="card-header border-bottom">
         <h6 class="m-0">Users</h6>
       </div>
       <div class="card-body pt-0">
         <div class="row border-bottom py-2 bg-light">
           <div class="col-12 col-sm-6"></div>
           <div class="col-12 col-sm-6 d-flex mb-2 mb-sm-0">
             <button type="button" class="btn btn-sm btn-white ml-auto mr-auto ml-sm-auto mr-sm-0 mt-3 mt-sm-0">All Users&rarr;</button>
           </div>
         </div>
       </div>
     </div>
   </div>
  <!-- End Users Stats -->
  <!-- Users By Device Stats -->
   <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
     <div class="card card-small h-100">
       <div class="card-header border-bottom">
         <h6 class="m-0">Users by device</h6>
       </div>
       <div class="card-body d-flex py-0"></div>
       <div class="card-footer border-top">
         <div class="row">
           <div class="col">
             <select class="custom-select custom-select-sm" style="max-width: 130px;">
               <option selected>Last Week</option>
               <option value="1">Today</option>
               <option value="2">Last Month</option>
               <option value="3">Last Year</option>
             </select>
           </div>
           <div class="col text-right view-report">
             <a href="#">Full report &rarr;</a>
           </div>
         </div>
       </div>
     </div>
   </div>
    <!-- End Users By Device Stats -->
    <!-- New Draft Component -->
   <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
      <!-- Quick Post -->
     <div class="card card-small h-100">
       <div class="card-header border-bottom">
         <h6 class="m-0">New Draft</h6>
       </div>
       <div class="card-body d-flex flex-column">
         <form class="quick-post-form">
           <div class="form-group">
             <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
               placeholder="Brave New World"> </div>
           <div class="form-group">
             <textarea class="form-control"
               placeholder="Words can be like X-rays if you use them properly..."></textarea>
           </div>
           <div class="form-group mb-0">
             <button type="submit" class="btn btn-accent">Create Draft</button>
           </div>
         </form>
       </div>
     </div>
      <!-- End Quick Post -->
   </div>
    <!-- End New Draft Component -->
    <!-- Discussions Component -->
   <div class="col-lg-5 col-md-12 col-sm-12 mb-4">
     <div class="card card-small blog-comments">
       <div class="card-header border-bottom">
         <h6 class="m-0">Discussions</h6>
       </div>
       <div class="card-body p-0">
         <div class="blog-comments__item d-flex p-3">
           <div class="blog-comments__avatar mr-3">
             <img src="images/avatars/1.jpg" alt="User avatar" /> </div>
           <div class="blog-comments__content">
             <div class="blog-comments__meta text-muted">
               <a class="text-secondary" href="#">James Johnson</a> on
               <a class="text-secondary" href="#">Hello World!</a>
               <span class="text-muted">– 3 days ago</span>
             </div>
             <p class="m-0 my-1 mb-2 text-muted">Well, the way they make shows is, they make one show ...</p>
             <div class="blog-comments__actions">
               <div class="btn-group btn-group-sm">
                 <button type="button" class="btn btn-white">
                   <span class="text-success">
                     <i class="material-icons">check</i>
                   </span> Approve </button>
                 <button type="button" class="btn btn-white">
                   <span class="text-danger">
                     <i class="material-icons">clear</i>
                   </span> Reject </button>
                 <button type="button" class="btn btn-white">
                   <span class="text-light">
                     <i class="material-icons">more_vert</i>
                   </span> Edit </button>
               </div>
             </div>
           </div>
         </div>
         <div class="blog-comments__item d-flex p-3">
           <div class="blog-comments__avatar mr-3">
             <img src="images/avatars/2.jpg" alt="User avatar" /> </div>
           <div class="blog-comments__content">
             <div class="blog-comments__meta text-muted">
               <a class="text-secondary" href="#">James Johnson</a> on
               <a class="text-secondary" href="#">Hello World!</a>
               <span class="text-muted">– 4 days ago</span>
             </div>
             <p class="m-0 my-1 mb-2 text-muted">After the avalanche, it took us a week to climb out. Now...
             </p>
             <div class="blog-comments__actions">
               <div class="btn-group btn-group-sm">
                 <button type="button" class="btn btn-white">
                   <span class="text-success">
                     <i class="material-icons">check</i>
                   </span> Approve </button>
                 <button type="button" class="btn btn-white">
                   <span class="text-danger">
                     <i class="material-icons">clear</i>
                   </span> Reject </button>
                 <button type="button" class="btn btn-white">
                   <span class="text-light">
                     <i class="material-icons">more_vert</i>
                   </span> Edit </button>
               </div>
             </div>
           </div>
         </div>
         <div class="blog-comments__item d-flex p-3">
           <div class="blog-comments__avatar mr-3">
             <img src="images/avatars/3.jpg" alt="User avatar" /> </div>
           <div class="blog-comments__content">
             <div class="blog-comments__meta text-muted">
               <a class="text-secondary" href="#">James Johnson</a> on
               <a class="text-secondary" href="#">Hello World!</a>
               <span class="text-muted">– 5 days ago</span>
             </div>
             <p class="m-0 my-1 mb-2 text-muted">My money's in that office, right? If she start giving me...
             </p>
             <div class="blog-comments__actions">
               <div class="btn-group btn-group-sm">
                 <button type="button" class="btn btn-white">
                   <span class="text-success">
                     <i class="material-icons">check</i>
                   </span> Approve </button>
                 <button type="button" class="btn btn-white">
                   <span class="text-danger">
                     <i class="material-icons">clear</i>
                   </span> Reject </button>
                 <button type="button" class="btn btn-white">
                   <span class="text-light">
                     <i class="material-icons">more_vert</i>
                   </span> Edit </button>
               </div>
             </div>
           </div>
         </div>
       </div>
       <div class="card-footer border-top">
         <div class="row">
           <div class="col text-center view-report">
             <button type="submit" class="btn btn-white">View All Comments</button>
           </div>
         </div>
       </div>
     </div>
   </div>
    <!-- End Discussions Component -->
    <!-- Top Referrals Component -->
   <div class="col-lg-3 col-md-12 col-sm-12 mb-4">
     <div class="card card-small">
       <div class="card-header border-bottom">
         <h6 class="m-0">Categories</h6>
       </div>
       <div class="card-body p-0">
         <ul class="list-group list-group-small list-group-flush py-2">
           @if (count($categories) > 0)
               @foreach ($categories as $category)
               <li class="list-group-item d-flex px-3 py-0">
                <span class="text-semibold text-fiord-blue">{{ $category->title }}</span>
                <span class="ml-auto text-right text-semibold text-reagent-gray">{{ rand(10, 100) }}</span>
              </li>
               @endforeach
           @else
            <li class="list-group-item d-flex px-3">
              <span class="text-semibold text-fiord-blue">Categories</span>
              <span class="ml-auto text-right text-semibold text-reagent-gray">0</span>
            </li>
           @endif
         </ul>
       </div>
       <div class="card-footer border-top">
         <div class="row">
           <div class="col">
             <select class="custom-select custom-select-sm">
               <option selected>Last Week</option>
               <option value="1">Today</option>
               <option value="2">Last Month</option>
               <option value="3">Last Year</option>
             </select>
           </div>
           <div class="col text-right view-report">
             <a href="#">Full report &rarr;</a>
           </div>
         </div>
       </div>
     </div>
   </div>
    <!-- End Top Referrals Component -->
 </div>
</div>
@endsection