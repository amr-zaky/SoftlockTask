@include('layouts.header')
<section class="section-subscribe">
<div class="container">
    
<div id="accordion" class="text-center">
@include('layouts.messages')
    <div class="card frontCard">
        <div class="card-header" id="headingOne">
            <h5 class="mb-0 text-center">
                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                   Encrypt Files
                </button>
            </h5>
        </div>

        <div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
                <form action="{{route('encryptFile')}}" method="post" enctype="multipart/form-data">

                    <input type="hidden" name="_token" value="{{csrf_token()}}">

                    <div class="form-group">
                        <label for="sourceFile">Chose File To Encrypt</label>
                        <br><br><br>
                        <input class="sourceFile" type="file" name="sourceFile"  required="required">
                        <br><br><br>
                    </div>

                    <div class="form-group">
                        <label for="algorithm">Chose Algorithm Modes To Encrypt</label>
                        <select name="algorithm">
                            <option  value="AES-256-CBC">AES-256-CBC</option>
                        </select>
                    
                    </div>

                    <div class="form-group">
                        <label for="key"> Secret Key</label>
                    
                        <input type="text" class="form-input" name="key"  required="required">
                        
                    </div>

                    <button type="submit" class="btn btn-primary pl-3 pr-3">Submit</button>
                </form>


            </div>
        </div>
    </div>
    <div class="card frontCard">
        <div class="card-header" id="headingTwo">
            <h5 class="mb-0 text-center">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Decrypt Files
                </button>
            </h5>
        </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
            <div class="card-body">


                <form action="{{route('decryptFile')}}" method="post" enctype="multipart/form-data">

                    <input type="hidden" name="_token" value="{{csrf_token()}}">

                    <div class="form-group">
                
                        <label for="sourceFile">Chose File to Decrypt</label>
                    <br><br><br>
                        <input class="sourceFile" type="file" name="sourceFile"  required="required">
                    </div>

                    <div class="form-group">
                        <label for="algorithm">Chose Algorithm Modes To Encrypt</label>
                        <select name="algorithm">
                            <option  value="AES-256-CBC">AES-256-CBC</option>
                        </select>
                    
                    </div>
                    <div class="form-group">
                        <label for="key"> Secret Key</label>
                    
                        <input type="text" class="form-input" name="key"  required="required">
                        
                    </div>

                    <button type="submit" class="btn btn-primary pl-3 pr-3">Submit</button>
                </form>



            </div>
        </div>
    </div>
</div>

<h3>Selected File Info</h3>
<table  class="table">
    <thead>
       <tr>
       <th>Name</th>
        <th>Size</th>
        <th>Extension</th>
       </tr>
    </thead>

    <tbody>
        <tr scope="row">
            <td><p id="namefile"></p></td>
            <td ><p id="size"></p></td></td>
            <td> <p id="extension"></p></td>
        </tr>
    </tbody>
</table>
</div>
</section>


@push('custom-scripts')
        <script>
            $(".sourceFile").change(function() {
                var fileName=this.files[0].name;
                var size=this.files[0].size;
                var extension=fileName.substr(fileName.lastIndexOf('.') + 1);
                $("#namefile").text(fileName);
                $("#size").text(size);
                $("#extension").text(extension);
            });
        </script>
@endpush

@include('layouts.footer')
