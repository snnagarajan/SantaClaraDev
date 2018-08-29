<?php
 require_once( get_cfg_var('doc_root') . '/include/ConnectPHP/Connect_init.phph' );
 require_once('include/init.phph');
 initConnectAPI("custom_script","Password@123");
use RightNow\Connect\v1_2 as RNCPHP;
error_reporting(0);
//echo "entering try block";

load_curl();
try{
	
set_include_path('/vhosts/sccgovaa/euf/assets/tcpdf');
require_once('config/tcpdf_config.php');
require_once('tcpdf.php');

if(isset($_REQUEST['appealid']))
	{
		$iid =$_REQUEST['appealid'];
        
       // $val=FetchRowValues($iid);	

        //exit;

        // Extend the TCPDF class to create custom Header and Footer
        class MYPDF extends TCPDF {

            //Page header

        /*public function Header() {
                // Logo
                // $image_file = K_PATH_IMAGES.'County_of_Santa_Clara.jpg';
                // $this->Image($image_file, 80, 10, 35, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
                // Set font
                $this->SetFont('times', 'B', 10);
                // Title
                $this->Cell(0,0, '', 0, false, 'C', 0, '', 0, false, 'M', 'M');
            }
        
        */
            // Page footer
            public function Footer() {
                // Position at 15 mm from bottom
                $this->SetY(-15);
                // Set font
                $this->SetFont('helvetica', 'B', 10);
                // Page number
                $this->Cell(0, 10, 'THIS DOCUMENT IS SUBJECT TO PUBLIC INSPECTION ', 0, false, 'C', 0, '', 0, false, 'T', 'M');
            }
        
        }


        // create new PDF document
        $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', true);
        //$pdf->setHeaderData($ln='/images/County_of_Santa_Clara.jpg', $lw=0, $ht='', $hs='<table cellspacing="0" cellpadding="1" border="1">tr><td rowspan="3">test</td><td>test</td></tr></table>', $tc=array(0,0,0), $lc=array(0,0,0));
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Shankar N');
        $pdf->SetTitle('Appeal Form AA Letter');
        $pdf->SetSubject('AA Letters');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');


        define ('PDF_HEADER_TITLE', 'BOE-305-AH (P1) REV. 08 (01-15)');

        define ('PDF_FONT_SIZE_MAIN', 6);

        // set default header data
        //$pdf->SetHeaderData('', '', 'BOE-305-AH (P1) REV. 08 (01-15)123test', 'BOE-305-AH (P1) REV. 08 (01-15)');

        $pdf->SetHeaderData('','', '', 'BOE-305-AH (P1) REV. 08 (01-15)');
        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, '15', PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin('3');
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        // ---------------------------------------------------------

        // set font
        $pdf->SetFont('times', '', 8);

        // add a page
        $pdf->AddPage();
        $img = K_PATH_IMAGES;
        $img_data = K_PATH_IMAGES.'/county-of-santa-clara-bw-seal_web100.jpg';

       // $image = base64_encode(file_get_contents($imageLocation));
       
    //    $img_data = "data:image/jpg;base64,$image";

// set some text to print
        $html = <<<EOD
        <style>
            .bl{border-left:1px solid #000}
            .br{border-right:1px solid #000}
            .bt{border-top:1px solid #000}
            .bb{border-bottom:1px solid #000}
            .b{border:1px solid #000}
            .tbl-b td{border:1px solid #000}
            
        </style>
        <table border="0" >
        <tbody>
        <tr>
        <td style= "font-size:12px;">
        <b>ASSESSMENT APPEAL APPLICATION</b>
        </td>
         <td rowspan="2" style= "font-size:12px;padding-top:10px" align="center">
		 <br /><br />
		 <img src="{{image_data}}" style="height:75px;width:75px;margin-top:5px" />
                <br />
                <b>COUNTY OF SANTA CLARA<br />
                Assessment Appeals Board</b><br />
                70 W. Hedding Street, 10th Floor, East Wing<br />
                    San Jose, CA 95110 (408) 299-5088
            </td>
			<td class="b" align="right">
				<b>APPLICATION NUMBER:</b>    CLERK USE ONLY
				<br /><br /><br />
				<input type="checkbox" name="hdel" value="1" /> &nbsp; Hand Delivered
			</td>
        </tr>
        <tr>
        <td style="font-size:10px;">
        This form contains all of the requests for information that are required for filing an application for changed assessment.
        Failure to complete this application may result in rejection of the application and/or denial of the appeal. Applicants should be prepared to submit additional information if requested by the assessor or at the time of the hearing. Failure to provide information at the hearing the appeals board considers necessary may result in the continuance of the hearing or denial of the appeal. For additional information or to file your appeal online visit our website at <a href="http://www.sccgov.org/AssessmentAppeals">www.sccgov.org/AssessmentAppeals</a><br /> <strong style="font-size:10px;">Do not attach hearing evidence to this application.</strong>
        </td>
        </tr>
        </tbody>
        </table>
        <table border="0" cellpadding="3" cellspacing="0">
            <tbody>
                <tr>
                    <td colspan="6" class="bb">
                        <h4>1. APPLICANT INFORMATION - PLEASE PRINT</h4>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">NAME OF APPLICANT (LAST, FIRST, MIDDLE INITIAL, BUSINESS, OR TRUST Name)
                        <br /> {{app_last_name}}{{app_first_name}}{{app_middle_name}}
                    </td>
                    <td colspan="2" class="bl">E-MAIL ADDRESS
                        <br /> {{app_email}}
                    </td>
                </tr>
                <tr>
                    <td colspan="6" class="bt bb">MAILING ADDRESS OF APPLICANT (STREET ADDRESS OR P. O. BOX)
                        <br /> {{app_po_addr}} {{app_street_addr}}
                    </td>
                </tr>
                <tr>
                    <td colspan="1" class="br">CITY
                        <br /> {{app_city_addr}}
                    </td>
                    <td colspan="1" class="br">STATE
                        <br /> {{app_state_addr}}
                    </td>
                    <td colspan="1" class="br">ZIPCODE
                        <br /> {{app_zip_addr}}
                    </td>
                    <td colspan="1" class="br">DAYTIME TELEPHONE
                        <br /> {{app_dayphone_addr}}
                    </td>
                    <td colspan="1" class="br">ALTERNATE TELEPHONE
                        <br /> {{app_altphone_addr}}
                    </td>
                    <td colspan="1">FAX NO.
                        <br /> {{app_fax_addr}}
                    </td>
                </tr>
                <tr>
                    <td colspan="6" class="bt bb"  >
                        <b>2. CONTACT INFORMATION - AGENT, ATTORNEY, OR RELATIVE OF APPLICANT if applicable - (REPRESENTATION IS OPTIONAL)</b>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">NAME OF AGENT, ATTORNEY, OR RELATIVE (LAST, FIRST, MIDDLE INITIAL)
                        <br /> {{ag_last_name}} {{ag_middle_name}}{{ag_first_name}}
                    </td>
                    <td colspan="3" class="bl">E-MAIL ADDRESS
                        <br /> {{ag_email}}
                    </td>
                </tr>
                <tr>
                    <td colspan="6" class="bt bb">COMPANY NAME
                        <br /> {{ag_company_name}}
                    </td>
                </tr>
                <tr>
                    <td colspan="6">CONTACT PERSON IF OTHER THAN ABOVE (LAST, FIRST, MIDDLE INITIAL)
                        <br /> &nbsp;
                    </td>
                </tr>
                <tr>
                    <td colspan="6" class="bb bt">MAILING ADDRESS (STREET ADDRESS OR P. O. BOX)
                        <br /> {{ag_po_addr}} {{ag_street_addr}}
                    </td>
                </tr>
                <tr>
                    <td colspan="1" class="br">CITY
                        <br /> {{ag_city_addr}}
                    </td>
                    <td colspan="1" class="br">STATE
                        <br /> {{ag_state_addr}}
                    </td>
                    <td colspan="1" class="br">ZIPCODE
                        <br /> {{ag_zip_addr}}
                    </td>
                    <td colspan="1" class="br">DAYTIME TELEPHONE
                        <br /> {{ag_dayphone_addr}}
                    </td>
                    <td colspan="1" class="br">ALTERNATE TELEPHONE
                        <br /> {{ag_altphone_addr}}
                    </td>
                    <td colspan="1">FAX NO.
                        <br /> {{ag_fax_addr}}
                    </td>
                </tr>
                <tr>
                    <td colspan="6" class="b">
                        <b>AUTHORIZATION OF AGENT
                        The following information must be completed (or attached to this application - see instructions) unless the agent is a licensed
                        California attorney as indicated in the Certification section, or a spouse, child, parent, registered domestic
                        partner, or the person affected. If the applicant is a business entity, the agent&#39;s authorization must
                        be signed by an officer or authorized employee of the business.</b>
                    </td>
                </tr>
                <tr>
                    <td colspan="6" class="bb bl br">
                        <b>The person named in Section 2 above is hereby authorized to act as my agent in this application and may inspect
                            assessor&#39;s records, enter in stipulation agreements, and otherwise settle issues relating to this
                            application.</b>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="br bl">SIGNATURE OF APPLICANT, OFFICER, OR AUTHORIZED EMPLOYEE
                        <form action="/cgi-bin/hello_get.cgi" method="get"><br/>
                            <input name="Signature" size="25" type="text" />&nbsp;</form>
                        &nbsp;</td>
                    <td colspan="2" class="br">TITLE
                        <br /> &nbsp;
                    </td>
                    <td colspan="2" class="br">DATE
                        <br /> &nbsp;
                    </td>
                </tr>
                <tr>
                    <td colspan="6" class="bt">
                        <b>3. PROPERTY IDENTIFICATION INFORMATION</b>
                    </td>
                </tr>
                <tr>
                    <td colspan="1">
                    <form action="/cgi-bin/hello_get.cgi" method="get"> <input name="prop_info1" type="checkbox" value="1" readonly="true" />Yes</form></td>
                    <td colspan="1">
                        <input name="prop_info2" type="checkbox" value="1" readonly="true" />No</td>
                    <td colspan="4">Is this property a single-family dwelling that is occupied as the principal place of residence by the owner?</td>
                </tr>
                <tr>
                    <td colspan="6" class="bb">
                        <b>ENTER APPLICABLE NUMBER FROM YOUR NOTICE/TAX BILL</b>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="br bb">ASSESSOR&#39;S PARCEL NUMBER
                        <br /> {{apn}}
                    </td>
                    <td colspan="2" class="br bb">ASSESSMENT NUMBER
                        <br /> {{assesment_no}}
                    </td>
                    <td colspan="2"  class="bb">FEE NUMBER
                        <br /> {{fee_no}}
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="br bb">ACCOUNT NUMBER
                        <br /> {{acc_no}}
                    </td>
                    <td colspan="4" class="bb">TAX BILL NUMBER
                        <br /> {{tax_bill_no}}
                    </td>
                </tr>
                <tr>
                    <td colspan="4" class="br bb">PROPERTY ADDRESS OR LOCATION
                        <br /> {{property_address}}
                    </td>
                    <td colspan="2" class="bb">DOING BUSINESS AS (DBA), if appropriate
                        <br /> {{dba}}
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        <b>PROPERTY TYPE</b>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input name="Prop_Name0" type="checkbox" value="0" readonly="true" {{SINGLE-FAMILY / CONDOMINIUM / TOWNHOUSE / DUPLEX}} />SINGLE-FAMILY / CONDOMINIUM / TOWNHOUSE / DUPLEX</td>
                    <td colspan="2">
                        <input name="Prop_Name1" type="checkbox" value="1" readonly="true" {{AGRICULTURAL}} />AGRICULTURAL</td>
                    <td colspan="2">
                        <input name="Prop_Name2" type="checkbox" value="2" readonly="true" {{POSSESSORY INTEREST}} />POSSESSORY INTEREST</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input name="Prop_Name3" type="checkbox" value="3" readonly="true" {{ASSESSOR&#39;S PARCEL NUMBER}} />ASSESSOR&#39;S PARCEL NUMBER</td>
                    <td colspan="2">
                        <input name="Prop_Name4" type="checkbox" value="4" readonly="true" {{MULTI-FAMILY/APARTMENTS}}/>{{MULTI-FAMILY/APARTMENTS_DATA}}</td>
                    <td colspan="2">
                        <input name="Prop_Name5" type="checkbox" value="5" readonly="true" {{MANUFACTURED HOME}} />MANUFACTURED HOME</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input name="Prop_Name6" type="checkbox" value="6" readonly="true" {{COMMERCIAL/INDUSTRIAL}} />COMMERCIAL/INDUSTRIAL</td>
                    <td colspan="2">
                        <input name="Prop_Name7" type="checkbox" value="7" readonly="true" {{WATER CRAFT}}/>WATER CRAFT</td>
                    <td colspan="2">
                        <input name="Prop_Name8" type="checkbox" value="8" readonly="true" {{AIRCRAFT}}/>AIRCRAFT</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input name="Prop_Name9" type="checkbox" value="9" readonly="true" {{BUSINESS PERSONAL PROPERTY/FIXTURES}}/>BUSINESS PERSONAL PROPERTY/FIXTURES</td>
                    <td colspan="4">
                        <input name="Prop_Name10" type="checkbox" value="10" readonly="true" {{OTHER}}/>{{OTHER_DATA}}</td>
                </tr>
                <tr>
                    <td colspan="6">
                        <table cellpadding="3" cellspacing="0" class="tbl-b">
                            <tbody>
                                <tr>
                                    <td colspan="2">
                                        <strong>4. Value</strong>
                                    </td>
                                    <td colspan="2">A. VALUE ON ROLL</td>
                                    <td colspan="2">B. APPLICANT&#39;S OPINION OF VALUE</td>
                                </tr>
                                <tr>
                                    <td colspan="2">LAND</td>
                                    <td colspan="2">{{land_value_roll}}</td>
                                    <td colspan="2">{{land_value_app}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">IMPROVEMENT/STRUCTURES</td>
                                    <td colspan="2">{{imp_value_roll}}</td>
                                    <td colspan="2">{{imp_value_app}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">FIXTURES</td>
                                    <td colspan="2">{{fixture_value_roll}}</td>
                                    <td colspan="2">{{fixture_value_app}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">PERSONAL PROPERTY (see instructions)</td>
                                    <td colspan="2">{{per_prop_value_roll}}</td>
                                    <td colspan="2">{{per_prop_value_app}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">MINERAL RIGHTS</td>
                                    <td colspan="2">{{min_rights_value_roll}}</td>
                                    <td colspan="2">{{min_rights_value_app}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">TREES &amp; VINES</td>
                                    <td colspan="2">{{trees_value_roll}}</td>
                                    <td colspan="2">{{trees_value_app}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">OTHER</td>
                                    <td colspan="2">{{others_value_roll}}</td>
                                    <td colspan="2">{{others_value_app}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">TOTAL</td>
                                    <td colspan="2">{{total_value_roll}}</td>
                                    <td colspan="2">{{total_value_app}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">PENALTIES (amount or percent)</td>
                                    <td colspan="2">{{penal_value_roll}}</td>
                                    <td colspan="2">{{penal_value_app}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        <b>5. TYPE OF ASSESSMENT BEING APPEALED. Check only one. See instructions for filing periods</b>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <input name="reg_ass" type="checkbox" value="1" readonly="true" {{assess_type1}} />REGULAR ASSESSMENT - VALUE AS OF JANUARY 1 OF THE CURRENT YEAR</td>
                </tr>
                <tr>
                    <td colspan="1">
                        <input name="sup_ass" type="checkbox" value="1" readonly="true" {{assess_type2}} />SUPPLEMENTAL ASSESSMENT</td>
                </tr>
                <tr>
                    <td colspan="1">*DATE OF NOTICE:</td>
                    <td colspan="1">ROLL YEAR:</td>
                </tr>
                <tr>
                    <td colspan="1">
                        <input name="roll1" type="checkbox" value="1" readonly="true" {{assess_type3}}/>ROLL CHANGE</td>
                    <td colspan="1">
                        <input name="roll2" type="checkbox" value="1" readonly="true" {{assess_type4}}/>ESCAPE ASSESSMENT</td>
                    <td colspan="1">
                        <input name="roll3" type="checkbox" value="1" readonly="true" {{assess_type5}}/>CALAMITY REASSESSMENT</td>
                    <td colspan="3">
                        <input name="roll4" type="checkbox" value="1" readonly="true" {{assess_type6}}/>PENALTY ASSESSMENT</td>
                </tr>
                <tr>
                    <td colspan="2">*DATE OF NOTICE: <u>{{date_of_notice}}</u></td>
                    <td colspan="2">ROLL YEAR: <u>{{roll_year2}}</u></td>
                </tr>
                <tr>
                    <td style="text-align:center; vertical-align:middle">
                        <strong>Must attach copy of notice</strong>
                    </td>
                    <td style="text-align:center; vertical-align:middle">
                        <strong>** Each roll year requires a separate application</strong>
                    </td>
                </tr>
                <tr>
                    <td colspan="6" class="bt">
                        <b>6. REASON FOR FILING APPEAL (FACTS)</b>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">If you are uncertain of which item to check, please check &quot;I. OTHER&quot; and provide a brief explanation
                        of your reasons for filing this application. The reasons that I rely upon to support requested changes in
                        value are as follows:</td>
                </tr>
                <tr>
                    <td colspan="2">A. DECLINE IN VALUE</td>
                </tr>
                <tr>
                    <td colspan="4">
                        <input name="div" type="checkbox" value="1" readonly="true" {{rof_dec_in_val_chk}} />&nbsp;The assessor&#39;s roll value exceeds the market value as of January 1 of the current year.</td>
                </tr>
                <tr>
                    <td colspan="2">B. CHANGE IN OWNERSHIP</td>
                </tr>
                <tr>
                </tr>
                <tr>
                    <td colspan="4">
                        <input name="cio0" type="checkbox" value="1" readonly="true" {{rof_change_owner1_chk}} />1. No change in ownership occurred on the date of <u>{{rof_date_owner_change}}</u> </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <input name="cio1" type="checkbox" value="1" readonly="true" {{rof_change_owner2_chk}} />2. Base year value for the change in ownership established on the date of <u>{{rof_date_owner_change2}}</u> is incorrect.</td>
                </tr>
                <tr>
                    <td colspan="2">C. NEW CONSTRUCTION</td>
                </tr>
                <tr>
                </tr>
                <tr>
                    <td colspan="4">
                        <input name="nc0" type="checkbox" value="1" readonly="true" {{rof_new_con1_chk}} />1. No new construction occured on the date of <u>{{rof_new_con_date}}</u></td>
                </tr>
                <tr>
                    <td colspan="4">
                        <input name="nc1" type="checkbox" value="1" readonly="true" {{rof_new_con2_chk}} />2. Base year value for the completed new construction established on the date of <u>{{rof_new_con_date}}</u> is incorrect.</td>
                </tr>
                <tr>
                    <td colspan="4">
                        <input name="nc2" type="checkbox" value="1" readonly="true" {{rof_new_con3_chk}} />3. Value of construction in progress on January 1 is incorrect.</td>
                </tr>
                <tr>
                    <td colspan="2">D. CALAMITY REASSESSMENT</td>
                </tr>
                <tr>
                    <td colspan="4">
                    <input name="cr" type="checkbox" value="1" readonly="true" {{rof_cal_reassess_chk}} />Assessor&#39;s reduced value is incorrect for property damaged by misfortune or calamity.</td>
                </tr>
                <tr>
                    <td colspan="6">E. BUSINESS PERSONAL PROPERTY/FIXTURES. Assessor&#39;s value of personal property and/or fixtures exceeds market
                        value.</td>
                </tr>
                <tr>
                </tr>
                <tr>
                    <td colspan="4">
                        <input name="bppf0" type="checkbox" value="1" readonly="true" {{rof_bus_per_prop1_chk}} />1. All personal property/fixtures.</td>
                </tr>
                <tr>
                    <td colspan="4">
                        <input name="bppf1" type="checkbox" value="1" readonly="true" {{rof_bus_per_prop2_chk}} />2. Only a portion of the personal property/fixtures. Attach description of those items.</td>
                </tr>
                <tr>
                    <td colspan="2">F. PENALTY ASSESSMENT</td>
                </tr>
                <tr>
                    <td colspan="4">
                    <input name="pa" type="checkbox" value="1" readonly="true" {{rof_pen_assess_chk}}/>Penalty assessment is not justified</td>
                </tr>
                <tr>
                    <td colspan="2">G. CLASSIFICATION/ALLOCATION</td>
                </tr>
                <tr>
                </tr>
                <tr>
                    <td colspan="4">
                    <input name="ca0" type="checkbox" value="1" readonly="true" {{rof_class1_chk}}/>1. Classification of property is incorrect</td>
                </tr>
                <tr>
                    <td colspan="4">
                        <input name="ca1" type="checkbox" value="1" readonly="true" {{rof_class2_chk}}/>2. Allocation of value of property is incorrect (e.g., between land and improvements).</td>
                </tr>
                <tr>
                    <td colspan="6">H. APPEAL AFTER AN AUDIT. Must include description of each property, issues being appealed, and your opinion
                        of value.</td>
                </tr>
                <tr>
                </tr>
                <tr>
                    <td colspan="4">
                        <input name="app_audit0" type="checkbox" value="1" readonly="true" {{rof_appeal_aft_aud1_check}} />1. Amount of escape assessment is incorrect.</td>
                </tr>
                <tr>
                    <td colspan="4">
                        <input name="app_audit1" type="checkbox" value="1" readonly="true" {{rof_appeal_aft_aud2_check}} />2. Assessment of property of the assessee at the location is incorrect.</td>
                </tr>
                <tr>
                    <td>I. OTHER</td>
                </tr>
                <tr>
                    <td colspan="4">
                        <input name="other_exp" type="checkbox" value="1" {{rof_other_check}} readonly="true"/>Explanation (attach sheet if necessary) <u>{{rof_other}}</u></td>
                </tr>
            </tbody>
        </table>

        <table cellpadding="0" cellspacing="2" style="width:100%">
            <tbody>
                <tr>
                    <td colspan="8" class="bt">
                        <strong>7. WRITTEN FINDINGS OF FACTS ($400 per appeal plus </strong>
                        <strong>balance</strong>
                        <strong> of costs incurred by the attorney) See Instructions.</strong>
                    </td>
                </tr>
                <tr>
                <td colspan="5">
                    <input name="wff0" type="checkbox" value="1" readonly="true" {{FOF_ARE}} />Are requested.</td>
                <td colspan="3">
                    <input name="wff1" type="checkbox" value="1" readonly="true" {{FOF_ARE_NOT}} />Are not requested.</td>
                            </tr>
                <tr>
                    <td colspan="8" class="bt">
                        <strong>8. THIS APPLICATION IS DESIGNATED AS A CLAIM FOR REFUND See instructions.</strong>
                    </td>
                </tr>
                <tr>
                    <td colspan="5">
                        <input name="claim0" type="checkbox" value="1" readonly="true" {{CLAIM_REFUND_YES}} />Yes</td>
                    <td colspan="3">
                        <input name="claim1" type="checkbox" value="1" readonly="true" {{CLAIM_REFUND_NO}} />No</td>
                </tr>
                <tr>
                    <td colspan="8" class="bt">
                        <strong>9. A VALUE HEARING OFFICER IS REQUESTED (ONLY applies to single family residences, cooperatives, condominium,
                            <br
                            /> or multiple-family dwellings of four units or less; OR any other type of real property valued at $500,000
                            or less)</strong>
                    </td>
                </tr>
                <tr>
                    <td colspan="5">
                    <input name="val_req0" type="checkbox" value="1" readonly="true" {{HEAR_OFF_YES}} />Yes</td>
                    <td colspan="3">
                    <input name="val_req1" type="checkbox" value="1" readonly="true" {{HEAR_OFF_NO}} />No</td>
                </tr>
                <tr>
                    <td colspan="8">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="8" style="text-align:center" class="bb bt">
                        <strong>CERTIFICATION</strong>
                    </td>
                </tr>
                <tr>
                    <td colspan="8">I certify (or declare) under penalty of perjury under the laws of the State of California that the foregoing
                        and all information hereon, including any accompanying statements or documents, is true, correct, and complete
                        to the best of my knowledge and belief and that I am (1) the owner of the property or the person affected
                        (i.e., a person having a direct economic interest in the payment of taxes on that property -- &quot;The Applicant&quot;),
                        (2) an agent authorized by the applicant under item 2 of this application, or (3) an attorney licensed to
                        practice law in the State of California, State Bar Number ---- , who has been retained by the applicant and
                        has been authorized by that person to file this application.</td>
                </tr>
                <tr>
                    <td colspan="5" class="bt bb br">SIGNATURE(Use Blue Pen - Original signature required on paper-filed application)<br/>
                        <form action="/cgi-bin/hello_get.cgi" method="get">
                            <input name="Signature" size="45" type="text" />&nbsp;</form>
                    </td>
                    <td colspan="2" class="br bb bt">SIGNED AT (CITY, STATE)<br/>
                        <form action="/cgi-bin/hello_get.cgi" method="get">
                            <input name="Signature" size="25" type="text" />&nbsp;</form>
                    </td>
                    <td class="bb bt">DATE<br/>
                        <form action="/cgi-bin/hello_get.cgi" method="get">
                            <input name="Signature" size="15" type="text" />&nbsp;</form>
                    </td>
                </tr>
                <tr>
                    <td colspan="8">
                        <strong>NAME (Please Print)</strong><br/>
                        {{app_last_name}} {{app_first_name}} {{app_middle_name}}
                    </td>
                </tr>
                <tr>
                    <td colspan="8" class="bt">FILING STATUS (IDENTIFY RELATIONSHIP TO APPLICANT NAMED IN SECTION 1)</td>
                </tr>
                <tr>
                    <td colspan="1">
                        <input name="fs0" type="checkbox" value="1" {{RELATION1}} readonly="true" />OWNER</td>
                    <td colspan="1">
                        <input name="fs1" type="checkbox" value="1" {{RELATION2}} readonly="true" />AGENT</td>
                    <td colspan="1">
                        <input name="fs2" type="checkbox" value="1" {{RELATION3}} readonly="true" />ATTORNEY</td>
                    <td colspan="1">
                        <input name="fs3" type="checkbox" value="1" {{RELATION4}} readonly="true"/>SPOUSE</td>
                    <td colspan="1">
                        <input name="fs4" type="checkbox" value="1" {{RELATION5}} readonly="true" />REGISTERED DOMESTIC PARTNER</td>
                    <td colspan="1">
                        <input name="fs5" type="checkbox" value="1" {{RELATION6}} readonly="true" />CHILD</td>
                    <td colspan="1">
                        <input name="fs6" type="checkbox" value="1" {{RELATION7}} readonly="true" />PARENT</td>
                    <td colspan="1">
                        <input name="fs7" type="checkbox" value="1" {{RELATION8}} readonly="true" />PERSON AFFECTED</td>
                </tr>
                <tr>
                    <td colspan="6">
                        <input name="fs8" type="checkbox" value="1" {{RELATION9}} readonly="true" />CORPORATE OFFICER OR DESIGNATED EMPLOYEE</td>
                </tr>
            </tbody>
        </table>
EOD;

//Fetching the appeal row 
$val=FetchRowValues($iid);


    //   echo "<pre>";print_r($val); exit;
    // updating the static HTML with dynamic text

            $keydata =array();	
            $valuedata =array();
			$keydata[0] = "{{Current Date}}";
			$valuedata[0] = date("m-d-Y");
            $i =1;
            foreach($val as $k=>$v)
            {
                $keydata[$i] = "{{".$k."}}";
                $valuedata[$i] = $v;
				$i++;
            }
            if($val['prop_type'] != '') {
				if(!strstr($proptype,"OTHER:")){
					$keydata[$i] = "{{OTHER_DATA}}";
                    $valuedata[$i] = "OTHER: _____";
                    $i++;
				}
				if(!strstr($proptype,"MULTI-FAMILY/APARTMENTS:")){
					$keydata[$i] = "{{MULTI-FAMILY/APARTMENTS_DATA}}";
					$valuedata[$i] = 'MULTI-FAMILY/APARTMENTS: NO. OF UNITS _____';
					$i++;
				}
				$proptype = explode(";",$val['prop_type']);
				foreach($proptype as $pdata) {
					if(strstr($pdata,"OTHER")) {
						$keydata[$i] = "{{OTHER}}";
						$valuedata[$i] = 'checked="checked"';
						$i++;
						$keydata[$i] = "{{OTHER_DATA}}";
						$odata = explode(":", $pdata);
						$valuedata[$i] = $odata[1];
						$i++;
					} else if(strstr($pdata,"MULTI-FAMILY/APARTMENTS:")) {
						$keydata[$i] = "{{MULTI-FAMILY/APARTMENTS}}";
						$valuedata[$i] = 'checked="checked"';
						$i++;
						$keydata[$i] = "{{MULTI-FAMILY/APARTMENTS_DATA}}";
						$mdata = explode(":", $pdata);
						$valuedata[$i] = $mdata[1];
						$i++;
					} else {
						$keydata[$i] = "{{".$pdata."}}";
						$valuedata[$i] = 'checked="checked"';
						$i++;
					}
                }
            } 
            
            if($val['rof_new_con1'] == 1) {
                $keydata[$i] = "{{rof_new_con1_chk}}";
                $valuedata[$i] = 'checked="checked"';
                $i++;
            } else if($val['rof_new_con1'] == 0) {
                $keydata[$i] = "{{rof_new_con1_chk}}";
                $valuedata[$i] = ' ';
                $i++;
            }
            if($val['rof_new_con2'] == 1) {
                $keydata[$i] = "{{rof_new_con2_chk}}";
                $valuedata[$i] = 'checked="checked"';
                $i++;
            } else if($val['rof_new_con2'] == 0) {
                $keydata[$i] = "{{rof_new_con2_chk}}";
                $valuedata[$i] = ' ';
                $i++;
            }
            if($val['rof_new_con3'] == 1) {
                $keydata[$i] = "{{rof_new_con3_chk}}";
                $valuedata[$i] = 'checked="checked"';
                $i++;
            } else if($val['rof_new_con3'] == 0) {
                $keydata[$i] = "{{rof_new_con3_chk}}";
                $valuedata[$i] = ' ';
                $i++;
            }
            if($val['relation']) {
                $keydata[$i] = "{{RELATION".$val['relation']."}}";
                $valuedata[$i] = 'checked="checked"';
                $i++;
            }
			if($val['assess_type']) {
                $keydata[$i] = "{{assess_type".$val['relation']."}}";
                $valuedata[$i] = 'checked="checked"';
                $i++;
            }
            if($val['val_hear_off'] == 1) {
                $keydata[$i] = "{{HEAR_OFF_YES}}";
                $valuedata[$i] = 'checked="checked"';
                $i++;
            } else if($val['val_hear_off'] == 0) {
                $keydata[$i] = "{{HEAR_OFF_NO}}";
                $valuedata[$i] = 'checked="checked"';
                $i++;
            }

            if($val['claim_refund'] == 1) {
                $keydata[$i] = "{{CLAIM_REFUND_YES}}";
                $valuedata[$i] = 'checked="checked"';
                $i++;
            } else if($val['claim_refund'] == 0) {
                $keydata[$i] = "{{CLAIM_REFUND_NO}}";
                $valuedata[$i] = 'checked="checked"';
                $i++;
            }
            
            if($val['rof_dec_in_val'] == 1) {
                $keydata[$i] = "{{rof_dec_in_val_chk}}";
                $valuedata[$i] = 'checked="checked"';
                $i++;
            } else if($val['rof_dec_in_val'] == 0) {
                $keydata[$i] = "{{rof_dec_in_val_chk}}";
                $valuedata[$i] = 'checked="checked"';
                $i++;
            }

            if($val['rof_appeal_aft_aud1'] == 1) {
                $keydata[$i] = "{{rof_appeal_aft_aud1_check}}";
                $valuedata[$i] = 'checked="checked"';
                $i++;
            } else if($val['rof_appeal_aft_aud1'] == 0) {
                $keydata[$i] = "{{rof_appeal_aft_aud1_check}}";
                $valuedata[$i] = ' ';
                $i++;
            }

            if($val['rof_appeal_aft_aud2'] == 1) {
                $keydata[$i] = "{{rof_appeal_aft_aud2_check}}";
                $valuedata[$i] = 'checked="checked"';
                $i++;
            } else if($val['rof_appeal_aft_aud2'] == 0) {
                $keydata[$i] = "{{rof_appeal_aft_aud2_check}}";
                $valuedata[$i] = ' ';
                $i++;
            }

            if($val['fof'] == 1) {
                $keydata[$i] = "{{FOF_ARE}}";
                $valuedata[$i] = 'checked="checked"';
                $i++;
            } else if($val['fof'] == 0) {
                $keydata[$i] = "{{FOF_ARE_NOT}}";
                $valuedata[$i] = 'checked="checked"';
                $i++;
            }

            if($val['rof_other'] != '') {
                $keydata[$i] = "{{rof_other_check}}";
                $valuedata[$i] = 'checked="checked"';
                $i++;
            }
            
            if($val['rof_class1'] == 1) {
                $keydata[$i] = "{{rof_class1_chk}}";
                $valuedata[$i] = 'checked="checked"';
                $i++;
            } else if($val['rof_class1'] == 0) {
                $keydata[$i] = "{{rof_class1_chk}}";
                $valuedata[$i] = ' ';
                $i++;
            }
            if($val['rof_class2'] == 1) {
                $keydata[$i] = "{{rof_class2_chk}}";
                $valuedata[$i] = 'checked="checked"';
                $i++;
            } else if($val['rof_class2'] == 0) {
                $keydata[$i] = "{{rof_class2_chk}}";
                $valuedata[$i] = ' ';
                $i++;
            }

            if($val['rof_bus_per_prop1'] == 1) {
                $keydata[$i] = "{{rof_bus_per_prop1_chk}}";
                $valuedata[$i] = 'checked="checked"';
                $i++;
            } else if($val['rof_bus_per_prop1'] == 0) {
                $keydata[$i] = "{{rof_bus_per_prop1_chk}}";
                $valuedata[$i] = ' ';
                $i++;
            }

            if($val['rof_bus_per_prop2'] == 1) {
                $keydata[$i] = "{{rof_bus_per_prop2_chk}}";
                $valuedata[$i] = 'checked="checked"';
                $i++;
            } else if($val['rof_bus_per_prop2'] == 0) {
                $keydata[$i] = "{{rof_bus_per_prop2_chk}}";
                $valuedata[$i] = ' ';
                $i++;
            }

            if($val['rof_cal_reassess'] == 1) {
                $keydata[$i] = "{{rof_cal_reassess_chk}}";
                $valuedata[$i] = 'checked="checked"';
                $i++;
            } else if($val['rof_cal_reassess'] == 0) {
                $keydata[$i] = "{{rof_cal_reassess_chk}}";
                $valuedata[$i] = ' ';
                $i++;
            }

            if($val['rof_pen_assess'] == 1) {
                $keydata[$i] = "{{rof_pen_assess_chk}}";
                $valuedata[$i] = 'checked="checked"';
                $i++;
            } else if($val['rof_pen_assess'] == 0) {
                $keydata[$i] = "{{rof_pen_assess_chk}}";
                $valuedata[$i] = ' ';
                $i++;
            }

            if($val['rof_change_owner1'] == 1) {
                $keydata[$i] = "{{rof_change_owner1_chk}}";
                $valuedata[$i] = 'checked="checked"';
                $i++;
            } else if($val['rof_change_owner1'] == 0) {
                $keydata[$i] = "{{rof_change_owner1_chk}}";
                $valuedata[$i] = ' ';
                $i++;
            }

            if($val['rof_change_owner2'] == 1) {
                $keydata[$i] = "{{rof_change_owner2_chk}}";
                $valuedata[$i] = 'checked="checked"';
                $i++;
            } else if($val['rof_change_owner2'] == 0) {
                $keydata[$i] = "{{rof_change_owner2_chk}}";
                $valuedata[$i] = ' ';
                $i++;
            }
            $keydata[$i] = "{{image_data}}";
            $valuedata[$i] = $img_data;
            $i++;

            $templateresult = str_replace($keydata, $valuedata, $html);
			if($_GET['print'] == 1) {
				echo $templateresult; exit;
			}
        $pdf->writeHTML($templateresult, true, false, false, false, '');

        // ---------------------------------------------------------

        //Close and output PDF document
        ob_clean();
        // Downloading the PDF Form
       //$pdf->Output('AA_Form_Appeal.pdf', 'I');

        //Returning the PDF as base 64 data
         $base64data=$pdf->Output($filename,'S');
	     echo base64_encode($base64data);
    }
}
catch(Exception $error){
	echo $error->getMessage();
}


function FetchRowValues($appealid)
{
	try
    {
        $dbquery="select * from Appeal.Appeal where id=".$appealid;
        //echo $dbquery; exit;

        $rmas = RNCPHP\ROQL::query($dbquery)->next();
        while($rma = $rmas->next())
        {
            return $rma;
        }
    }
    catch(RNCPHP\ConnectAPIErrorBase $e)
    {
                \RightNow\Utils\Framework::logMessage($e->getMessage());
    }
}
?>
