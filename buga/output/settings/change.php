<?php
print "<form method=\"post\" name=\"frm\" id=\"frm\">\n";
print "<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"1\" class=\"text\">\n";
print "<table border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"1\" class=\"text\" width=\"800px\">\n";
print "<tr>\n";
print "	<td colspan=\"2\" align=\"center\" id=\"infoTableHeader\">User - $user_login</td> \n";
print "</tr> \n";
print "<tr class=row1>\n";
print "	<td  class=\"label\">Name:</td>\n";
print "	<td class=\"content\"><input type=\"text\" value=\"$user_name\" name=\"user_name\" id=\"user_name\"></td>\n";
print "</tr>\n";
print "<tr class=row1>\n";
print "	<td  class=\"label\">Surname:</td>\n";
print "	<td class=\"content\"><input type=\"text\" value=\"$user_surname\" name=\"user_surname\" id=\"user_surname\"></td>\n";
print "</tr>\n";
print "<tr class=row1>\n";
print "	<td  class=\"label\">Company:</td>\n";
print "	<td class=\"content\"><input type=\"text\" value=\"$user_company\" name=\"user_company\" id=\"user_company\"></td>\n";
print "</tr>\n";
print "<tr class=row1>\n";
print "	<td  class=\"label\">Email:</td>\n";
print "	<td class=\"content\"><input type=\"text\" value=\"$user_email\" name=\"user_email\" id=\"user_email\"><input type=\"hidden\" value=\"$action\" name=\"user_info_id\" id=\"user_info_id\"></td>\n";
print "</tr>\n";
print "<tr class=row1>\n";
print "	<td  class=\"label\">Address1:</td>\n";
print "	<td class=\"content\"><input type=\"text\" value=\"$user_address1\" name=\"user_address1\" id=\"user_address1\"></td>\n";
print "</tr>\n";
print "<tr class=row1>\n";
print "	<td  class=\"label\">Address2:</td>\n";
print "	<td class=\"content\"><input type=\"text\" value=\"$user_address2\" name=\"user_address2\" id=\"user_address2\"></td>\n";
print "</tr>\n";
print "<tr class=row1>\n";
print "	<td  class=\"label\">City:</td>\n";
print "	<td class=\"content\"><input type=\"text\" value=\"$user_city\" name=\"user_city\" id=\"user_city\"></td>\n";
print "</tr>\n";
print "<tr class=row1>\n";
print "	<td  class=\"label\">Country:</td>\n";
print "	<td class=\"content\">";
print "<select name=\"Country\"> \n";
print "	<option value=\"$user_country\" selected=\"selected\">$user_country</option> \n";
print "	<option value=\"United States\">United States</option> \n";
print "	<option value=\"United Kingdom\">United Kingdom</option> \n";
print "	<option value=\"Afghanistan\">Afghanistan</option> \n";
print "	<option value=\"Albania\">Albania</option> \n";
print "	<option value=\"Algeria\">Algeria</option> \n";
print "	<option value=\"American Samoa\">American Samoa</option> \n";
print "	<option value=\"Andorra\">Andorra</option> \n";
print "	<option value=\"Angola\">Angola</option> \n";
print "	<option value=\"Anguilla\">Anguilla</option> \n";
print "	<option value=\"Antarctica\">Antarctica</option> \n";
print "	<option value=\"Antigua and Barbuda\">Antigua and Barbuda</option> \n";
print "	<option value=\"Argentina\">Argentina</option> \n";
print "	<option value=\"Armenia\">Armenia</option> \n";
print "	<option value=\"Aruba\">Aruba</option> \n";
print "	<option value=\"Australia\">Australia</option> \n";
print "	<option value=\"Austria\">Austria</option> \n";
print "	<option value=\"Azerbaijan\">Azerbaijan</option> \n";
print "	<option value=\"Bahamas\">Bahamas</option> \n";
print "	<option value=\"Bahrain\">Bahrain</option> \n";
print "	<option value=\"Bangladesh\">Bangladesh</option> \n";
print "	<option value=\"Barbados\">Barbados</option> \n";
print "	<option value=\"Belarus\">Belarus</option> \n";
print "	<option value=\"Belgium\">Belgium</option> \n";
print "	<option value=\"Belize\">Belize</option> \n";
print "	<option value=\"Benin\">Benin</option> \n";
print "	<option value=\"Bermuda\">Bermuda</option> \n";
print "	<option value=\"Bhutan\">Bhutan</option> \n";
print "	<option value=\"Bolivia\">Bolivia</option> \n";
print "	<option value=\"Bosnia and Herzegovina\">Bosnia and Herzegovina</option> \n";
print "	<option value=\"Botswana\">Botswana</option> \n";
print "	<option value=\"Bouvet Island\">Bouvet Island</option> \n";
print "	<option value=\"Brazil\">Brazil</option> \n";
print "	<option value=\"British Indian Ocean Territory\">British Indian Ocean Territory</option> \n";
print "	<option value=\"Brunei Darussalam\">Brunei Darussalam</option> \n";
print "	<option value=\"Bulgaria\">Bulgaria</option> \n";
print "	<option value=\"Burkina Faso\">Burkina Faso</option> \n";
print "	<option value=\"Burundi\">Burundi</option> \n";
print "	<option value=\"Cambodia\">Cambodia</option> \n";
print "	<option value=\"Cameroon\">Cameroon</option> \n";
print "	<option value=\"Canada\">Canada</option> \n";
print "	<option value=\"Cape Verde\">Cape Verde</option> \n";
print "	<option value=\"Cayman Islands\">Cayman Islands</option> \n";
print "	<option value=\"Central African Republic\">Central African Republic</option> \n";
print "	<option value=\"Chad\">Chad</option> \n";
print "	<option value=\"Chile\">Chile</option> \n";
print "	<option value=\"China\">China</option> \n";
print "	<option value=\"Christmas Island\">Christmas Island</option> \n";
print "	<option value=\"Cocos (Keeling) Islands\">Cocos (Keeling) Islands</option> \n";
print "	<option value=\"Colombia\">Colombia</option> \n";
print "	<option value=\"Comoros\">Comoros</option> \n";
print "	<option value=\"Congo\">Congo</option> \n";
print "	<option value=\"Congo, The Democratic Republic of The\">Congo, The Democratic Republic of The</option> \n";
print "	<option value=\"Cook Islands\">Cook Islands</option> \n";
print "	<option value=\"Costa Rica\">Costa Rica</option> \n";
print "	<option value=\"Cote D'ivoire\">Cote D'ivoire</option> \n";
print "	<option value=\"Croatia\">Croatia</option> \n";
print "	<option value=\"Cuba\">Cuba</option> \n";
print "	<option value=\"Cyprus\">Cyprus</option> \n";
print "	<option value=\"Czech Republic\">Czech Republic</option> \n";
print "	<option value=\"Denmark\">Denmark</option> \n";
print "	<option value=\"Djibouti\">Djibouti</option> \n";
print "	<option value=\"Dominica\">Dominica</option> \n";
print "	<option value=\"Dominican Republic\">Dominican Republic</option> \n";
print "	<option value=\"Ecuador\">Ecuador</option> \n";
print "	<option value=\"Egypt\">Egypt</option> \n";
print "	<option value=\"El Salvador\">El Salvador</option> \n";
print "	<option value=\"Equatorial Guinea\">Equatorial Guinea</option> \n";
print "	<option value=\"Eritrea\">Eritrea</option> \n";
print "	<option value=\"Estonia\">Estonia</option> \n";
print "	<option value=\"Ethiopia\">Ethiopia</option> \n";
print "	<option value=\"Falkland Islands (Malvinas)\">Falkland Islands (Malvinas)</option> \n";
print "	<option value=\"Faroe Islands\">Faroe Islands</option> \n";
print "	<option value=\"Fiji\">Fiji</option> \n";
print "	<option value=\"Finland\">Finland</option> \n";
print "	<option value=\"France\">France</option> \n";
print "	<option value=\"French Guiana\">French Guiana</option> \n";
print "	<option value=\"French Polynesia\">French Polynesia</option> \n";
print "	<option value=\"French Southern Territories\">French Southern Territories</option> \n";
print "	<option value=\"Gabon\">Gabon</option> \n";
print "	<option value=\"Gambia\">Gambia</option> \n";
print "	<option value=\"Georgia\">Georgia</option> \n";
print "	<option value=\"Germany\">Germany</option> \n";
print "	<option value=\"Ghana\">Ghana</option> \n";
print "	<option value=\"Gibraltar\">Gibraltar</option> \n";
print "	<option value=\"Greece\">Greece</option> \n";
print "	<option value=\"Greenland\">Greenland</option> \n";
print "	<option value=\"Grenada\">Grenada</option> \n";
print "	<option value=\"Guadeloupe\">Guadeloupe</option> \n";
print "	<option value=\"Guam\">Guam</option> \n";
print "	<option value=\"Guatemala\">Guatemala</option> \n";
print "	<option value=\"Guinea\">Guinea</option> \n";
print "	<option value=\"Guinea-bissau\">Guinea-bissau</option> \n";
print "	<option value=\"Guyana\">Guyana</option> \n";
print "	<option value=\"Haiti\">Haiti</option> \n";
print "	<option value=\"Heard Island and Mcdonald Islands\">Heard Island and Mcdonald Islands</option> \n";
print "	<option value=\"Holy See (Vatican City State)\">Holy See (Vatican City State)</option> \n";
print "	<option value=\"Honduras\">Honduras</option> \n";
print "	<option value=\"Hong Kong\">Hong Kong</option> \n";
print "	<option value=\"Hungary\">Hungary</option> \n";
print "	<option value=\"Iceland\">Iceland</option> \n";
print "	<option value=\"India\">India</option> \n";
print "	<option value=\"Indonesia\">Indonesia</option> \n";
print "	<option value=\"Iran, Islamic Republic of\">Iran, Islamic Republic of</option> \n";
print "	<option value=\"Iraq\">Iraq</option> \n";
print "	<option value=\"Ireland\">Ireland</option> \n";
print "	<option value=\"Israel\">Israel</option> \n";
print "	<option value=\"Italy\">Italy</option> \n";
print "	<option value=\"Jamaica\">Jamaica</option> \n";
print "	<option value=\"Japan\">Japan</option> \n";
print "	<option value=\"Jordan\">Jordan</option> \n";
print "	<option value=\"Kazakhstan\">Kazakhstan</option> \n";
print "	<option value=\"Kenya\">Kenya</option> \n";
print "	<option value=\"Kiribati\">Kiribati</option> \n";
print "	<option value=\"Korea, Democratic People's Republic of\">Korea, Democratic People's Republic of</option> \n";
print "	<option value=\"Korea, Republic of\">Korea, Republic of</option> \n";
print "	<option value=\"Kuwait\">Kuwait</option> \n";
print "	<option value=\"Kyrgyzstan\">Kyrgyzstan</option> \n";
print "	<option value=\"Lao People's Democratic Republic\">Lao People's Democratic Republic</option> \n";
print "	<option value=\"Latvia\">Latvia</option> \n";
print "	<option value=\"Lebanon\">Lebanon</option> \n";
print "	<option value=\"Lesotho\">Lesotho</option> \n";
print "	<option value=\"Liberia\">Liberia</option> \n";
print "	<option value=\"Libyan Arab Jamahiriya\">Libyan Arab Jamahiriya</option> \n";
print "	<option value=\"Liechtenstein\">Liechtenstein</option> \n";
print "	<option value=\"Lithuania\">Lithuania</option> \n";
print "	<option value=\"Luxembourg\">Luxembourg</option> \n";
print "	<option value=\"Macao\">Macao</option> \n";
print "	<option value=\"Macedonia, The Former Yugoslav Republic of\">Macedonia, The Former Yugoslav Republic of</option> \n";
print "	<option value=\"Madagascar\">Madagascar</option> \n";
print "	<option value=\"Malawi\">Malawi</option> \n";
print "	<option value=\"Malaysia\">Malaysia</option> \n";
print "	<option value=\"Maldives\">Maldives</option> \n";
print "	<option value=\"Mali\">Mali</option> \n";
print "	<option value=\"Malta\">Malta</option> \n";
print "	<option value=\"Marshall Islands\">Marshall Islands</option> \n";
print "	<option value=\"Martinique\">Martinique</option> \n";
print "	<option value=\"Mauritania\">Mauritania</option> \n";
print "	<option value=\"Mauritius\">Mauritius</option> \n";
print "	<option value=\"Mayotte\">Mayotte</option> \n";
print "	<option value=\"Mexico\">Mexico</option> \n";
print "	<option value=\"Micronesia, Federated States of\">Micronesia, Federated States of</option> \n";
print "	<option value=\"Moldova, Republic of\">Moldova, Republic of</option> \n";
print "	<option value=\"Monaco\">Monaco</option> \n";
print "	<option value=\"Mongolia\">Mongolia</option> \n";
print "	<option value=\"Montserrat\">Montserrat</option> \n";
print "	<option value=\"Morocco\">Morocco</option> \n";
print "	<option value=\"Mozambique\">Mozambique</option> \n";
print "	<option value=\"Myanmar\">Myanmar</option> \n";
print "	<option value=\"Namibia\">Namibia</option> \n";
print "	<option value=\"Nauru\">Nauru</option> \n";
print "	<option value=\"Nepal\">Nepal</option> \n";
print "	<option value=\"Netherlands\">Netherlands</option> \n";
print "	<option value=\"Netherlands Antilles\">Netherlands Antilles</option> \n";
print "	<option value=\"New Caledonia\">New Caledonia</option> \n";
print "	<option value=\"New Zealand\">New Zealand</option> \n";
print "	<option value=\"Nicaragua\">Nicaragua</option> \n";
print "	<option value=\"Niger\">Niger</option> \n";
print "	<option value=\"Nigeria\">Nigeria</option> \n";
print "	<option value=\"Niue\">Niue</option> \n";
print "	<option value=\"Norfolk Island\">Norfolk Island</option> \n";
print "	<option value=\"Northern Mariana Islands\">Northern Mariana Islands</option> \n";
print "	<option value=\"Norway\">Norway</option> \n";
print "	<option value=\"Oman\">Oman</option> \n";
print "	<option value=\"Pakistan\">Pakistan</option> \n";
print "	<option value=\"Palau\">Palau</option> \n";
print "	<option value=\"Palestinian Territory, Occupied\">Palestinian Territory, Occupied</option> \n";
print "	<option value=\"Panama\">Panama</option> \n";
print "	<option value=\"Papua New Guinea\">Papua New Guinea</option> \n";
print "	<option value=\"Paraguay\">Paraguay</option> \n";
print "	<option value=\"Peru\">Peru</option> \n";
print "	<option value=\"Philippines\">Philippines</option> \n";
print "	<option value=\"Pitcairn\">Pitcairn</option> \n";
print "	<option value=\"Poland\">Poland</option> \n";
print "	<option value=\"Portugal\">Portugal</option> \n";
print "	<option value=\"Puerto Rico\">Puerto Rico</option> \n";
print "	<option value=\"Qatar\">Qatar</option> \n";
print "	<option value=\"Reunion\">Reunion</option> \n";
print "	<option value=\"Romania\">Romania</option> \n";
print "	<option value=\"Russian Federation\">Russian Federation</option> \n";
print "	<option value=\"Rwanda\">Rwanda</option> \n";
print "	<option value=\"Saint Helena\">Saint Helena</option> \n";
print "	<option value=\"Saint Kitts and Nevis\">Saint Kitts and Nevis</option> \n";
print "	<option value=\"Saint Lucia\">Saint Lucia</option> \n";
print "	<option value=\"Saint Pierre and Miquelon\">Saint Pierre and Miquelon</option> \n";
print "	<option value=\"Saint Vincent and The Grenadines\">Saint Vincent and The Grenadines</option> \n";
print "	<option value=\"Samoa\">Samoa</option> \n";
print "	<option value=\"San Marino\">San Marino</option> \n";
print "	<option value=\"Sao Tome and Principe\">Sao Tome and Principe</option> \n";
print "	<option value=\"Saudi Arabia\">Saudi Arabia</option> \n";
print "	<option value=\"Senegal\">Senegal</option> \n";
print "	<option value=\"Serbia and Montenegro\">Serbia and Montenegro</option> \n";
print "	<option value=\"Seychelles\">Seychelles</option> \n";
print "	<option value=\"Sierra Leone\">Sierra Leone</option> \n";
print "	<option value=\"Singapore\">Singapore</option> \n";
print "	<option value=\"Slovakia\">Slovakia</option> \n";
print "	<option value=\"Slovenia\">Slovenia</option> \n";
print "	<option value=\"Solomon Islands\">Solomon Islands</option> \n";
print "	<option value=\"Somalia\">Somalia</option> \n";
print "	<option value=\"South Africa\">South Africa</option> \n";
print "	<option value=\"South Georgia and The South Sandwich Islands\">South Georgia and The South Sandwich Islands</option> \n";
print "	<option value=\"Spain\">Spain</option> \n";
print "	<option value=\"Sri Lanka\">Sri Lanka</option> \n";
print "	<option value=\"Sudan\">Sudan</option> \n";
print "	<option value=\"Suriname\">Suriname</option> \n";
print "	<option value=\"Svalbard and Jan Mayen\">Svalbard and Jan Mayen</option> \n";
print "	<option value=\"Swaziland\">Swaziland</option> \n";
print "	<option value=\"Sweden\">Sweden</option> \n";
print "	<option value=\"Switzerland\">Switzerland</option> \n";
print "	<option value=\"Syrian Arab Republic\">Syrian Arab Republic</option> \n";
print "	<option value=\"Taiwan, Province of China\">Taiwan, Province of China</option> \n";
print "	<option value=\"Tajikistan\">Tajikistan</option> \n";
print "	<option value=\"Tanzania, United Republic of\">Tanzania, United Republic of</option> \n";
print "	<option value=\"Thailand\">Thailand</option> \n";
print "	<option value=\"Timor-leste\">Timor-leste</option> \n";
print "	<option value=\"Togo\">Togo</option> \n";
print "	<option value=\"Tokelau\">Tokelau</option> \n";
print "	<option value=\"Tonga\">Tonga</option> \n";
print "	<option value=\"Trinidad and Tobago\">Trinidad and Tobago</option> \n";
print "	<option value=\"Tunisia\">Tunisia</option> \n";
print "	<option value=\"Turkey\">Turkey</option> \n";
print "	<option value=\"Turkmenistan\">Turkmenistan</option> \n";
print "	<option value=\"Turks and Caicos Islands\">Turks and Caicos Islands</option> \n";
print "	<option value=\"Tuvalu\">Tuvalu</option> \n";
print "	<option value=\"Uganda\">Uganda</option> \n";
print "	<option value=\"Ukraine\">Ukraine</option> \n";
print "	<option value=\"United Arab Emirates\">United Arab Emirates</option> \n";
print "	<option value=\"United Kingdom\">United Kingdom</option> \n";
print "	<option value=\"United States\">United States</option> \n";
print "	<option value=\"United States Minor Outlying Islands\">United States Minor Outlying Islands</option> \n";
print "	<option value=\"Uruguay\">Uruguay</option> \n";
print "	<option value=\"Uzbekistan\">Uzbekistan</option> \n";
print "	<option value=\"Vanuatu\">Vanuatu</option> \n";
print "	<option value=\"Venezuela\">Venezuela</option> \n";
print "	<option value=\"Viet Nam\">Viet Nam</option> \n";
print "	<option value=\"Virgin Islands, British\">Virgin Islands, British</option> \n";
print "	<option value=\"Virgin Islands, U.S.\">Virgin Islands, U.S.</option> \n";
print "	<option value=\"Wallis and Futuna\">Wallis and Futuna</option> \n";
print "	<option value=\"Western Sahara\">Western Sahara</option> \n";
print "	<option value=\"Yemen\">Yemen</option> \n";
print "	<option value=\"Zambia\">Zambia</option> \n";
print "	<option value=\"Zimbabwe\">Zimbabwe</option>\n";
print "</select>\n";
print "</td>\n";
print "</tr>\n";
print "<tr class=row1>\n";
print "	<td  class=\"label\">Postcode:</td>\n";
print "	<td class=\"content\"><input type=\"text\" value=\"$user_postcode\" name=\"user_postcode\" id=\"user_postcode\"></td>\n";
print "</tr>\n";
print "<tr class=row1>\n";
print "	<td  class=\"label\">Telephone</td>\n";
print "	<td class=\"content\"><input type=\"text\" value=\"$user_telephone\" name=\"user_telephone\" id=\"user_telephone\"></td>\n";
print "</tr>\n";
print "<tr class=row1>\n";
print "	<td  class=\"label\">Country:</td>\n";
print "	<td class=\"content\">";
print "<select name=\"user_gender\"> \n";
print "	<option value=\"$user_gender\" selected=\"selected\">$user_gender</option> \n";
print "	<option value=\"male\">male</option> \n";
print "	<option value=\"female\">female</option> \n";
print "</tr>\n";
print "<tr class=row1>\n";
print "	<td  class=\"label\">Age</td>\n";
print "	<td class=\"content\"><input type=\"text\" value=\"$user_aged\" name=\"user_aged\" id=\"user_aged\">/
<input type=\"text\" value=\"$user_agem\" name=\"user_agem\" id=\"user_agem\">/
<input type=\"text\" value=\"$user_agey\" name=\"user_agey\" id=\"user_agey\"></td>\n";
print "</tr>\n";
print "<tr class=row1>\n";
print "	<td  class=\"label\">Memo</td>\n";
print "	<td class=\"content\"><textarea name=\"mtxDescription\" class=\"box\" id=\"mtxDescription\">" . nl2br($user_memo) . "</textarea></td>\n";
print "</tr>\n";
print "</table>\n";
print "<div align=center></p><input name=\"btn\" type=\"submit\" id=\"btn\" value=\"Modify\" class=\"box\"></div>\n";
print "</form>\n";
?>