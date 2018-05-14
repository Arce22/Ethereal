<?php
session_start();
require 'database.php';
if( isset($_SESSION['company_id'])) {
          header("Location: ");
}
   
   $error= '';
   

  
if(!empty($_POST['company_id']) && !empty($_POST['password']) ):


      
   
     $records1 = $conn->prepare('SELECT company_id,password,approval_status FROM company WHERE company_id = :company_id'); 
     
     $records1->bindParam(':company_id',  $_POST['company_id']);  
    
     $records1->execute();
     $results = $records1->fetch(PDO::FETCH_ASSOC);


  
      if(count($results) > 0 && $_POST['password'] == $results['password'] ) {
        if($results['approval_status'] ==TRUE){
              $_SESSION['company_id'] = $results['company_id'];
      
          header("Location: ./company_market.php");
        }

       else if( $results['approval_status'] ==NULL){
          echo '<script language="javascript">';
            echo 'alert("This company has not approved yet!")';
            echo '</script>';

          }
            else if( $results['approval_status'] ==FALSE){
          echo '<script language="javascript">';
            echo 'alert("This company is not approved!")';
            echo '</script>';

          }
       
      
       } else if(count($results) > 0 && $_POST['password'] != $results['password']) {
           echo '<script language="javascript">';
            echo 'alert("Password is incorrect!")';
            echo '</script>';
       }
     
endif;
   $flag1=TRUE;

  $records2 = $conn->prepare('select * from company'); // = ' .$_SESSION['company_id'].);
            $records2->execute();
            $results2 = $records2->fetchAll(); //(PDO::FETCH_ASSOC)

            foreach($results2 as $result2) {
              if($result2['company_id']==$_POST['company_id_signup'] )
              {
                $flag1=FALSE;
                  echo '<script language="javascript">';
              echo 'alert("There is already a Company with this name!")';
             echo '</script>';
              }

}
    
    // adding to player tabl   

if( !empty($_POST['company_id_signup']) && !empty($_POST['password_signup']) && !empty($_POST['company_name_signup']) && !empty($_POST['country_signup']) && !empty($_POST['webpage_signup']) && ($_POST['password_signup']==$_POST['password_r_signup'])
    && !empty($_POST['e_mail_signup'])&& !empty($_POST['zipcode_signup']) && !empty($_POST['district_signup']) && !empty($_POST['state_signup'])&& !empty($_POST['description_signup']) && $flag1==TRUE ):
  
    // adding to player table
     $records1 = $conn->prepare('insert into company VALUES( :company_id, :password, :company_name, NULL)');
     $records1->bindParam(':company_id',  $_POST['company_id_signup']);  
     $records1->bindParam(':password',  $_POST['password_signup']);
     $records1->bindParam(':company_name',  $_POST['company_name_signup']);
     $records1->execute();
    
    // adding to information table
    $records = $conn->prepare('insert into company_info VALUES(  :webpage, :company_id, :company_email,:zip, :state, :city, :district, :description)');
    $records->bindParam(':webpage',  $_POST['webpage_signup']);
    $records->bindParam(':company_id',  $_POST['company_id_signup']);
    $records->bindParam(':company_email',  $_POST['e_mail_signup']);
    $records->bindParam(':zip',  $_POST['zipcode_signup']);
    $records->bindParam(':state',  $_POST['state_signup']);
    $records->bindParam(':city',  $_POST['country_signup']);
    $records->bindParam(':district',  $_POST['district_signup']);
    $records->bindParam(':description',  $_POST['description_signup']);
    $records->execute();
     echo '<script language="javascript">';
  echo 'alert("You signed up sucessfully. Please wait for aprroval by admin!")';
  echo '</script>';

endif;

 
    if(($_POST['password_signup'])!=($_POST['password_r_signup'])){
      echo '<script language="javascript">';
      echo 'alert("Password and repeat password does not match!")';
      echo '</script>';
      

    }

?>


<html>
   
   <head>
      <title>Login Page</title>
      
      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:16px;
         }
         label {
            font-weight:bold;
            width:100px;
            font-size:16px;
         }
         .box {
            border:#666666 solid 1px;
         }
          .box1 {
            border:#666666 solid 1px;
         }
         
      </style>
      
   </head>
   <body bgcolor = "#FFFFFF">
   
      <div align = "left">
         <div style = "width:400px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>
            
            <div style = "margin:30px">
               
               <form action = "company.php" method = "post">
                <p>Please fill in this form to login</p>
                  <hr>
                  
                   <label for="company_id"><b>Username</b></label>
                 <input type="text" placeholder="Enter Username" name="company_id" required class = "box1"><br /><br />
                   <label for="password"><b>Password</b></label>
                  <input type="password" placeholder="Enter Password" name="password" required class = "box1"><br /><br />
                  <a href = "logout.php">Forgot your password?</a><br />
                 
                   <input type = "submit" value = " Login "/><br />
               </form>
               
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
               
            </div>
            
         </div>
         
      </div>

      <div align = "right">
         <div style = "width:500px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding: 15px;"><b>Sign up</b></div>
            
            <div style = "margin:10px;padding: 20px;">
               
               <form action = "company.php" method = "post">
                  
                
                  <p>Please fill in this form to create an account.</p>
                  <hr>
                  
                   <label for="company_id_signup"><b>Username</b></label>
                 <input type="text" placeholder="Enter Username" name="company_id_signup" required class = "box1"><br /><br />
                   <label for="password_signup"><b>Password</b></label>
                  <input type="password" placeholder="Enter Password" name="password_signup" required class = "box1"><br /><br />

                  <label for="psw-repeat"><b>Repeat Password</b></label>
                  <input type="password" placeholder="Repeat Password" name="password_r_signup" required class = "box1"><br /><br />


                  <label for="e_mail_signup"><b>Email</b></label>
                  <input type="text" placeholder="Enter Email" name="e_mail_signup" required class = "box1"><br /><br />
                  <label for="company_name"><b>Company Name</b></label>
                  <input type="text" placeholder="Enter company name" name="company_name_signup" required class = "box1"><br /><br />
                  <label for="web_page"><b>Web page</b></label>
                  <input type="text" placeholder="Enter webpage" name="webpage_signup" required class = "box1"><br /><br />
                  <label for="adress"><b>Adress</b></label>
                  <input type="text" placeholder="Zipcode" name="zipcode_signup" required class = "box1">
                    <input type="text" placeholder="State" name="state_signup" required class = "box1"><br /><br />
            <label for="country"><b>Country</b></label>
            <select "country" name="country_signup">
            <option value="Afghanistan">Afghanistan</option>
            <option value="Albania">Albania</option>
            <option value="Algeria">Algeria</option>
            <option value="American Samoa">American Samoa</option>
            <option value="Andorra">Andorra</option>
            <option value="Angola">Angola</option>
            <option value="Anguilla">Anguilla</option>
            <option value="Antartica">Antarctica</option>
            <option value="Antigua and Barbuda">Antigua and Barbuda</option>
            <option value="Argentina">Argentina</option>
            <option value="Armenia">Armenia</option>
            <option value="Aruba">Aruba</option>
            <option value="Australia">Australia</option>
            <option value="Austria">Austria</option>
            <option value="Azerbaijan">Azerbaijan</option>
            <option value="Bahamas">Bahamas</option>
            <option value="Bahrain">Bahrain</option>
            <option value="Bangladesh">Bangladesh</option>
            <option value="Barbados">Barbados</option>
            <option value="Belarus">Belarus</option>
            <option value="Belgium">Belgium</option>
            <option value="Belize">Belize</option>
            <option value="Benin">Benin</option>
            <option value="Bermuda">Bermuda</option>
            <option value="Bhutan">Bhutan</option>
            <option value="Bolivia">Bolivia</option>
            <option value="Bosnia and Herzegowina">Bosnia and Herzegowina</option>
            <option value="Botswana">Botswana</option>
            <option value="Bouvet Island">Bouvet Island</option>
            <option value="Brazil">Brazil</option>
            <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
            <option value="Brunei Darussalam">Brunei Darussalam</option>
            <option value="Bulgaria">Bulgaria</option>
            <option value="Burkina Faso">Burkina Faso</option>
            <option value="Burundi">Burundi</option>
            <option value="Cambodia">Cambodia</option>
            <option value="Cameroon">Cameroon</option>
            <option value="Canada">Canada</option>
            <option value="Cape Verde">Cape Verde</option>
            <option value="Cayman Islands">Cayman Islands</option>
            <option value="Central African Republic">Central African Republic</option>
            <option value="Chad">Chad</option>
            <option value="Chile">Chile</option>
            <option value="China">China</option>
            <option value="Christmas Island">Christmas Island</option>
            <option value="Cocos Islands">Cocos (Keeling) Islands</option>
            <option value="Colombia">Colombia</option>
            <option value="Comoros">Comoros</option>
            <option value="Congo">Congo</option>
            <option value="Congo">Congo, the Democratic Republic of the</option>
            <option value="Cook Islands">Cook Islands</option>
            <option value="Costa Rica">Costa Rica</option>
            <option value="Cota D'Ivoire">Cote d'Ivoire</option>
            <option value="Croatia">Croatia (Hrvatska)</option>
            <option value="Cuba">Cuba</option>
            <option value="Cyprus">Cyprus</option>
            <option value="Czech Republic">Czech Republic</option>
            <option value="Denmark">Denmark</option>
            <option value="Djibouti">Djibouti</option>
            <option value="Dominica">Dominica</option>
            <option value="Dominican Republic">Dominican Republic</option>
            <option value="East Timor">East Timor</option>
            <option value="Ecuador">Ecuador</option>
            <option value="Egypt">Egypt</option>
            <option value="El Salvador">El Salvador</option>
            <option value="Equatorial Guinea">Equatorial Guinea</option>
            <option value="Eritrea">Eritrea</option>
            <option value="Estonia">Estonia</option>
            <option value="Ethiopia">Ethiopia</option>
            <option value="Falkland Islands">Falkland Islands (Malvinas)</option>
            <option value="Faroe Islands">Faroe Islands</option>
            <option value="Fiji">Fiji</option>
            <option value="Finland">Finland</option>
            <option value="France">France</option>
            <option value="France Metropolitan">France, Metropolitan</option>
            <option value="French Guiana">French Guiana</option>
            <option value="French Polynesia">French Polynesia</option>
            <option value="French Southern Territories">French Southern Territories</option>
            <option value="Gabon">Gabon</option>
            <option value="Gambia">Gambia</option>
            <option value="Georgia">Georgia</option>
            <option value="Germany">Germany</option>
            <option value="Ghana">Ghana</option>
            <option value="Gibraltar">Gibraltar</option>
            <option value="Greece">Greece</option>
            <option value="Greenland">Greenland</option>
            <option value="Grenada">Grenada</option>
            <option value="Guadeloupe">Guadeloupe</option>
            <option value="Guam">Guam</option>
            <option value="Guatemala">Guatemala</option>
            <option value="Guinea">Guinea</option>
            <option value="Guinea-Bissau">Guinea-Bissau</option>
            <option value="Guyana">Guyana</option>
            <option value="Haiti">Haiti</option>
            <option value="Heard and McDonald Islands">Heard and Mc Donald Islands</option>
            <option value="Holy See">Holy See (Vatican City State)</option>
            <option value="Honduras">Honduras</option>
            <option value="Hong Kong">Hong Kong</option>
            <option value="Hungary">Hungary</option>
            <option value="Iceland">Iceland</option>
            <option value="India">India</option>
            <option value="Indonesia">Indonesia</option>
            <option value="Iran">Iran (Islamic Republic of)</option>
            <option value="Iraq">Iraq</option>
            <option value="Ireland">Ireland</option>
            <option value="Israel">Israel</option>
            <option value="Italy">Italy</option>
            <option value="Jamaica">Jamaica</option>
            <option value="Japan">Japan</option>
            <option value="Jordan">Jordan</option>
            <option value="Kazakhstan">Kazakhstan</option>
            <option value="Kenya">Kenya</option>
            <option value="Kiribati">Kiribati</option>
            <option value="Democratic People's Republic of Korea">Korea, Democratic People's Republic of</option>
            <option value="Korea">Korea, Republic of</option>
            <option value="Kuwait">Kuwait</option>
            <option value="Kyrgyzstan">Kyrgyzstan</option>
            <option value="Lao">Lao People's Democratic Republic</option>
            <option value="Latvia">Latvia</option>
            <option value="Lebanon" selected>Lebanon</option>
            <option value="Lesotho">Lesotho</option>
            <option value="Liberia">Liberia</option>
            <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
            <option value="Liechtenstein">Liechtenstein</option>
            <option value="Lithuania">Lithuania</option>
            <option value="Luxembourg">Luxembourg</option>
            <option value="Macau">Macau</option>
            <option value="Macedonia">Macedonia, The Former Yugoslav Republic of</option>
            <option value="Madagascar">Madagascar</option>
            <option value="Malawi">Malawi</option>
            <option value="Malaysia">Malaysia</option>
            <option value="Maldives">Maldives</option>
            <option value="Mali">Mali</option>
            <option value="Malta">Malta</option>
            <option value="Marshall Islands">Marshall Islands</option>
            <option value="Martinique">Martinique</option>
            <option value="Mauritania">Mauritania</option>
            <option value="Mauritius">Mauritius</option>
            <option value="Mayotte">Mayotte</option>
            <option value="Mexico">Mexico</option>
            <option value="Micronesia">Micronesia, Federated States of</option>
            <option value="Moldova">Moldova, Republic of</option>
            <option value="Monaco">Monaco</option>
            <option value="Mongolia">Mongolia</option>
            <option value="Montserrat">Montserrat</option>
            <option value="Morocco">Morocco</option>
            <option value="Mozambique">Mozambique</option>
            <option value="Myanmar">Myanmar</option>
            <option value="Namibia">Namibia</option>
            <option value="Nauru">Nauru</option>
            <option value="Nepal">Nepal</option>
            <option value="Netherlands">Netherlands</option>
            <option value="Netherlands Antilles">Netherlands Antilles</option>
            <option value="New Caledonia">New Caledonia</option>
            <option value="New Zealand">New Zealand</option>
            <option value="Nicaragua">Nicaragua</option>
            <option value="Niger">Niger</option>
            <option value="Nigeria">Nigeria</option>
            <option value="Niue">Niue</option>
            <option value="Norfolk Island">Norfolk Island</option>
            <option value="Northern Mariana Islands">Northern Mariana Islands</option>
            <option value="Norway">Norway</option>
            <option value="Oman">Oman</option>
            <option value="Pakistan">Pakistan</option>
            <option value="Palau">Palau</option>
            <option value="Panama">Panama</option>
            <option value="Papua New Guinea">Papua New Guinea</option>
            <option value="Paraguay">Paraguay</option>
            <option value="Peru">Peru</option>
            <option value="Philippines">Philippines</option>
            <option value="Pitcairn">Pitcairn</option>
            <option value="Poland">Poland</option>
            <option value="Portugal">Portugal</option>
            <option value="Puerto Rico">Puerto Rico</option>
            <option value="Qatar">Qatar</option>
            <option value="Reunion">Reunion</option>
            <option value="Romania">Romania</option>
            <option value="Russia">Russian Federation</option>
            <option value="Rwanda">Rwanda</option>
            <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 
            <option value="Saint LUCIA">Saint LUCIA</option>
            <option value="Saint Vincent">Saint Vincent and the Grenadines</option>
            <option value="Samoa">Samoa</option>
            <option value="San Marino">San Marino</option>
            <option value="Sao Tome and Principe">Sao Tome and Principe</option> 
            <option value="Saudi Arabia">Saudi Arabia</option>
            <option value="Senegal">Senegal</option>
            <option value="Seychelles">Seychelles</option>
            <option value="Sierra">Sierra Leone</option>
            <option value="Singapore">Singapore</option>
            <option value="Slovakia">Slovakia (Slovak Republic)</option>
            <option value="Slovenia">Slovenia</option>
            <option value="Solomon Islands">Solomon Islands</option>
            <option value="Somalia">Somalia</option>
            <option value="South Africa">South Africa</option>
            <option value="South Georgia">South Georgia and the South Sandwich Islands</option>
            <option value="Span">Spain</option>
            <option value="SriLanka">Sri Lanka</option>
            <option value="St. Helena">St. Helena</option>
            <option value="St. Pierre and Miguelon">St. Pierre and Miquelon</option>
            <option value="Sudan">Sudan</option>
            <option value="Suriname">Suriname</option>
            <option value="Svalbard">Svalbard and Jan Mayen Islands</option>
            <option value="Swaziland">Swaziland</option>
            <option value="Sweden">Sweden</option>
            <option value="Switzerland">Switzerland</option>
            <option value="Syria">Syrian Arab Republic</option>
            <option value="Taiwan">Taiwan, Province of China</option>
            <option value="Tajikistan">Tajikistan</option>
            <option value="Tanzania">Tanzania, United Republic of</option>
            <option value="Thailand">Thailand</option>
            <option value="Togo">Togo</option>
            <option value="Tokelau">Tokelau</option>
            <option value="Tonga">Tonga</option>
            <option value="Trinidad and Tobago">Trinidad and Tobago</option>
            <option value="Tunisia">Tunisia</option>
            <option value="Turkey">Turkey</option>
            <option value="Turkmenistan">Turkmenistan</option>
            <option value="Turks and Caicos">Turks and Caicos Islands</option>
            <option value="Tuvalu">Tuvalu</option>
            <option value="Uganda">Uganda</option>
            <option value="Ukraine">Ukraine</option>
            <option value="United Arab Emirates">United Arab Emirates</option>
            <option value="United Kingdom">United Kingdom</option>
            <option value="United States">United States</option>
            <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
            <option value="Uruguay">Uruguay</option>
            <option value="Uzbekistan">Uzbekistan</option>
            <option value="Vanuatu">Vanuatu</option>
            <option value="Venezuela">Venezuela</option>
            <option value="Vietnam">Viet Nam</option>
            <option value="Virgin Islands (British)">Virgin Islands (British)</option>
            <option value="Virgin Islands (U.S)">Virgin Islands (U.S.)</option>
            <option value="Wallis and Futana Islands">Wallis and Futuna Islands</option>
            <option value="Western Sahara">Western Sahara</option>
            <option value="Yemen">Yemen</option>
            <option value="Yugoslavia">Yugoslavia</option>
            <option value="Zambia">Zambia</option>
            <option value="Zimbabwe">Zimbabwe</option>
        </select>
                    <input type="text" placeholder="District" name="district_signup" required class = "box1"><br /><br />
                   <label for="description"><b>Description</b></label>
                  <input type="text" placeholder="Enter Description" name="description_signup" required class = "box1"><br /><br />
                 
                  <label>
                    <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
                  </label>


                 <input type = "submit" value = " Sign up "/><br />
               </form>
               
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
               
            </div>
            
         </div>
         
      </div>

   </body>
</html>