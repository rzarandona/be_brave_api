<?php
  /*
    app.php
    -> Creates an admin dashboard of the book submissions
  */

  require "results.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Submissions API Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://bootswatch.com/5/united/bootstrap.min.css">
</head>
<body>

  <nav class="navbar navbar-dark bg-primary">
    <div class="container">
      <a class="navbar-brand" href="http://157.245.51.194/api/hectors_post/be_brave/app.php">Book Submissions API Dashboard</a>
    </div>
  </nav>
  <div class="container">
    
    <table class="table table-hove table-striped table-responsive mt-4 mb-4" >
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Email</th>
          <th scope="col">Date Created</th>
          <th scope="col">Date Paid</th>
          <th scope="col">Order ID</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($book_submissions as $submission){?>

          <tr>
            <td><?php echo $submission['id']; ?></td>
            <td><?php echo $submission['email']; ?></td>
            <td><?php echo $submission['date_created']; ?></td>
            <td><?php echo $submission['date_paid']; ?></td>
            <td>
              <a
                target="_blank"
                href="http://157.245.51.194/sites/hp/wp-admin/post.php?post=<?php echo $submission['order_id'];?>&action=edit">
              <?php echo $submission['order_id']; ?>
              </a>
            </td>
            <td>
              <button
                class="btn btn-sm btn-primary"
                data-inner-pdf-link="<?php echo $submission['inner_pdf_link']; ?>"
                data-outer-pdf-link="<?php echo $submission['outer_pdf_link']; ?>"
                onclick="submit"
              >Print</button>
              <a target="_blank" href="<?php echo $submission['inner_pdf_link']; ?>" class="btn btn-sm btn-secondary">Inner PDF</a>
              <a target="_blank" href="<?php echo $submission['outer_pdf_link']; ?>" class="btn btn-sm btn-secondary">Outer PDF</a>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>

  </div>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
  
  <script src="https://cdn.jsdelivr.net/npm/leaflet-sidebar@0.2.4/src/L.Control.Sidebar.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/crypto-js@4.1.1/index.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/crypto-js@4.1.1/core.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/crypto-js@4.1.1/crypto-js.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/crypto-js@4.1.1/enc-base64.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/crypto-js@4.1.1/enc-base64url.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/crypto-js@4.1.1/enc-hex.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/crypto-js@4.1.1/enc-latin1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/crypto-js@4.1.1/enc-utf8.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/crypto-js@4.1.1/format-hex.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/crypto-js@4.1.1/enc-utf16.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/crypto-js@4.1.1/evpkdf.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/crypto-js@4.1.1/lib-typedarrays.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/crypto-js@4.1.1/format-openssl.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/crypto-js@4.1.1/hmac.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/crypto-js@4.1.1/hmac-sha224.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/crypto-js@4.1.1/hmac-sha256.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/crypto-js@4.1.1/hmac-sha384.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/crypto-js@4.1.1/hmac-sha512.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/crypto-js@4.1.1/hmac-sha3.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/crypto-js@4.1.1/hmac-sha1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/crypto-js@4.1.1/hmac-md5.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/crypto-js@4.1.1/hmac-ripemd160.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/crypto-js@4.1.1/mode-ctr.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/crypto-js@4.1.1/pad-iso10126.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/crypto-js@4.1.1/x64-core.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/crypto-js@4.1.1/tripledes.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/crypto-js@4.1.1/sha512.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/crypto-js@4.1.1/sha384.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/crypto-js@4.1.1/sha224.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/crypto-js@4.1.1/sha256.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/crypto-js@4.1.1/sha3.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/crypto-js@4.1.1/ripemd160.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/crypto-js@4.1.1/sha1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/crypto-js@4.1.1/rc4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/crypto-js@4.1.1/rabbit.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/crypto-js@4.1.1/rabbit-legacy.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/crypto-js@4.1.1/pad-zeropadding.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/crypto-js@4.1.1/pbkdf2.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/crypto-js@4.1.1/pad-pkcs7.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/crypto-js@4.1.1/pad-iso97971.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/crypto-js@4.1.1/pad-nopadding.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/crypto-js@4.1.1/pad-ansix923.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/crypto-js@4.1.1/mode-ofb.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/crypto-js@4.1.1/mode-ctr-gladman.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/crypto-js@4.1.1/mode-ecb.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/crypto-js@4.1.1/md5.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/crypto-js@4.1.1/mode-cfb.min.js"></script>
  
  <script src="https://cdn.jsdelivr.net/npm/axios@0.23.0/dist/axios.min.js"></script>
  
  <script>
  
        
      function submit(){

        let data = {
          "destination": {
            "name": "pureprint"
            },
          "orderData": {
                "sourceOrderId" : "TESTORDER121223",    
                "customerName" : "hectorspost",       
                "items" : [
                    {
                        "barcode" : "TESTORDER2-1",            
                        "shipmentIndex" : 0,            
                        "sourceItemId" : "TESTORDER2-1",            
                        "sku" : "hectorspost_staging",            
                        "quantity" : 3,            
                        "unitCost" : 0.0,            
                        "components" : [
                            {
                                "path" : "https://s3-eu-west-1.amazonaws.com/pureprint-connector/HectorsPost/Template/Template.pdf",                    
                                "fetch" : true,                    
                                "localFile" : false,                    
                                "code" : "text"
                            },
                            {
                                "path" : "https://s3-eu-west-1.amazonaws.com/pureprint-connector/HectorsPost/Template/Template.pdf",                    
                                "fetch" : true,                    
                                "localFile" : false,                    
                                "code" : "cover"
                            }
                            ]
                        
                    }],    
                "shipments" : [
                    {
                        "shipmentIndex" : 0,            
                        "shipTo" : 
                        {
                            "name" : "Test Tester ",                
                            "companyName" : "Test Company",                
                            "address1" : "Do Not Ship",                
                            "town" : "DO NOT SHIP",                
                            "postcode" : "1ES TE1",                
                            "isoCountry" : "GB"
                        },            
                        "shipByDate" : "2021-09-09T13:15:25.7654838+01:00",            
                        "canShipEarly" : false,            
                        "returnAddress" : 
                        {
                            "name" : "Test",                
                            "companyName" : "Pureprint Group",                
                            "address1" : "Beon House, Bellbrook Park",                
                            "town" : "Uckfield",                
                            "postcode" : "TN22 1PL",                
                            "isoCountry" : "GB"
                        },            
                        "carrier" : 
                        {
                            "alias" : "shippingtest"
                        },            
                        "dispatchAlert" : ""
                    }],    
                "tags" : ["0"]
            }
        }

        let method = "POST";
        let path = "/api/order"
        let timestamp = Math.floor(Date.now() / 1000);
        let secret = "a3b2f495e1dc171a45d686747a9478d9cdbe1ed646d25791";
        let token = "1916514645615";

            
        let stringToSign = method + " " + path + " " + timestamp;
        let signature = crypto.HmacSHA1(stringToSign,secret).toString(crypto.enc.Hex);
        let authHeader = token + ":" + signature;

        axios.post('https://pro-api.oneflowcloud.com/api/order', data, {
          headers: {
            'x-oneflow-authorization': authHeader,
            'Accept': 'application/json',
            'x-oneflow-date' : timestamp
          }
        })
        .then(res =>{
          console.log(res)
        })
        .catch(err => {
          console.log(err)
        })
      }
      

  </script>          


</body>
</html>