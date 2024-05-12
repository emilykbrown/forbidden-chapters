<style>
    
.img-container {
    position: relative;
    width: 100%;
    height: auto; /* Adjusts height according to the image */
    overflow: hidden;
}

.img-container img {
    display: block;
    margin: 0 auto;
    max-width: 100%;
    height: auto;
}


.overlay {
	position: absolute;
	top: 0;
	bottom: 0;
	left: 0;
	right: 0;
	background-color: rgb(0, 0, 0, 0.5);
	opacity: 0;
	transition: opacity 0.5s ease;
}

.img-container:hover .img {
	transform: scale(1.1);
}
.img-container:hover .overlay{
	opacity: 1;
}

.blurb-btn {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

/* .error {
	color: #ff0000;
} */
</style>

<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <div class="col mb-5">
                <div class="card h-100">
                <div class="img-container">
                    <img src="test-img/catchingfire.jpg" class="card-img-top img book-cover w-100" alt="Product images">
                    <div class="overlay">
                        <button type="button" class="btn btn-dark blurb-btn" data-toggle="modal" data-target="#blurb_modal">Open Modal</button>
                    </div>
                </div>
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Product name-->
                            <h5>Catching Fire</h5>
                            <p>Suzanne Collins | Young adult</p>
                            <p>$7.95</p>
                        </div>
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="row">
                            <div class="col text-center"><a class="btn btn-dark mt-auto" href="#">Buy Now</a>
                            </div>
                            <div class="col text-center"><a class="btn btn-dark mt-auto" href="#"><i
                                        class="fa fa-solid fa-cart-shopping"></i></a></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>



<div class="modal" id="blurb_modal">
  <div class="modal-dialog">
    <div class="modal-content">

    <!-- Modal Header -->
    <div class="modal-header">
        <h4 class="modal-title">Catching Fire</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      The final book in Suzanne Collins's worldwide bestselling Hunger Games trilogy is now available in paperback."My name is Katniss Everdeen. Why am I not dead? I should be dead."Katniss Everdeen, girl on fire, has survived, even though her home has been destroyed. There are rebels. There are new leaders. A revolution is unfolding.District 13 has come out of the shadows and is plotting to overthrow the Capitol. Though she's long been a part of the revolution, Katniss hasn't known it. Now it seems that everyone has had a hand in the carefully laid plans but her.The success of the rebellion hinges on Katniss's willingness to be a pawn, to accept responsibility for countless lives, and to change the course of the future of Panem. To do this, she must put aside her feelings of anger and distrust. She must become the rebels' Mockingjay - no matter what the cost.

    </div>


    </div>
  </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
