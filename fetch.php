<?php
require_once('connection.php');
$output = '';
if(isset($_POST["query"]))
{
	$search = mysqli_real_escape_string($conn, $_POST["query"]);
	$query = "SELECT * FROM tblproduct WHERE name LIKE '%".$search."%' ";
}
else
{
	$query = "SELECT * FROM tblproduct ORDER BY id";
}
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0)
{

	while($row = mysqli_fetch_array($result))
	{
		$output .= '
			    <div class="col-lg-4 col-md-6 col-sm-12 my-3">
                    <div class="advisor">
                        <img src=" '.$row["image"].'" class="img-fluid">
                        <div class="d-flex align-items-center justify-content-center text-white flex-column advisor-overlay px-3">
                            <h4 class="h4 text-uppercase text-white">'.$row["name"].'</h4>
                            <p class="text-center"><a data-toggle="modal" data-target="#card'.$row["id"].'" class="badge badge-pill badge-warning mx-2">See more</a></p>
                            <button type="button" class="btn btn-index">
                                LE <span class="badge badge-light">'.$row["price"].'</span>
                            </button>
                        </div>
                        <div class="p-4 advisor-info text-center">
                            <h4 class="name">'.$row["name"].'</h4>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="card'.$row["id"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Product info</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="container pt-5">
                                    <div class="row">
                                        <div class="m-auto col-md-8 text-center">
                                            <img src="'.$row["image"].'" class="img-fluid my-2" alt="">
                                            <h1 class="my-3 main-color">'.$row["name"].'</h1>
                                            <p class="my-3">'.$row["des"].'</p>
                                            <button type="button" class="btn btn-index my-3 ">
                                                LE <span class="badge badge-light">'.$row["price"].'</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                
		';
	}
	echo $output;
}
else
{
	echo '<h3 class="h3 m-auto">Data Not Found</h3>';
}
?>