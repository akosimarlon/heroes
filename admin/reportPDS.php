<?php
    require "fpdf.php";    
    include('authentication.php');
    include("includes/timezone.php");
    header("Content-type: application/pdf; charset=utf-8");
//$db = new PDO('mysql:host=localhost;dbname=ykgercov_dtr','ykgercov_dtr','AB1DIokBhcLwtr{');   //P@$$w0rd123456
$db = new PDO('mysql:host=localhost;dbname=tis','root','@DavaosurDB2023');
//define('PESO',chr(174));
class myPDF extends FPDF{    
    
    function headerTable(){
        $this->SetFont('Arial','BI',8);
        $this->Cell(1,0,'CS Form No. 212',0,2,'L');
        $this->SetFont('Arial','BI',8);
        $this->Cell(1,8,'Revised 2017',0,0,'L');                
        
        $this->SetFont('Arial','B',16);       
        $this->Cell(100);
        // Centered text in a framed 20*10 mm cell and line break
        $this->Cell(1,8,'PERSONAL DATA SHEET',0,1,'C');        

        $this->SetFont('Arial','BI',6.2);
        $this->Cell(1,10,'WARNING: Any misrepresentation made in the Personal Data Sheet and the Work Experience Sheet shall cause the filing of administrative/criminal case/s against the person concerned.',0,1,'L');
        
        $this->Cell(1,1,'READ THE ATTACHED GUIDE TO FILLING OUT THE PERSONAL DATA SHEET (PDS) BEFORE ACCOMPLISHING THE PDS FORM.',0,1,'L');
        $this->SetFont('Arial','',6.2);
        $this->Cell(1,5,'Print legibly. Tick appropriate boxes (     ) and use separate sheet if necessary. Indicate N/A if not applicable. ',0,0,'L');
        $this->SetFont('Arial','B',6.2);
        $this->Cell(108);
        $this->Cell(1,5,' DO NOT ABBREVIATE.',0,0,'L');

        $this->Cell(30);
        $this->SetFillColor(190,190,190);
        $this->Cell(15,5,'1. CS ID No.',1,0,'L',true); 
        $this->SetFont('Arial','BI',6.2);                  
        $this->Cell(40,5,' (Do not fill up. For CSC use only)',1,1,'R');
    }
    
    function personalInfo1($db){

        if(isset($_SESSION['auth_user']['user_empno'])){
            $user_id = $_GET['emp_no'];            
            $stmt = $db->query("SELECT * FROM personal_info WHERE emp_no='$user_id'");            
            while($data = $stmt->fetch(PDO::FETCH_OBJ)){
    
                $this->SetFont('Arial','I',10);
                $this->SetFillColor(115,115,115);
                $this->SetTextColor(255,255,255);
                $this->Cell(195,5,'I. PERSONAL INFORMATION',1,1,'L',true);
                
                $this->SetFont('Arial','',7);
                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(45,5,'2. SURNAME','L',0,'L',true);
                $this->SetTextColor(0,0,255);
                $this->Cell(150,5,strtoupper($data->lastname),1,1,'L');

                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(45,5,'    FIRST NAME','L',0,'L',true);
                $this->SetTextColor(0,0,255);
                $this->Cell(110,5,strtoupper($data->firstname),1,0,'L');

                $this->SetFont('Arial','',6);
                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);                
                $this->Cell(30,5,'NAME EXTENSION (JR., SR)  ','TLB',0,'L',true);
                $this->SetTextColor(0,0,255);
                $this->Cell(10,5,strtoupper($data->exname),'TRB',1,'L',true);

                $this->SetFont('Arial','',7);
                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(45,5,'    MIDDLE NAME','L',0,'L',true);
                $this->SetTextColor(0,0,255);
                $this->Cell(150,5,strtoupper(utf8_decode($data->middlename)),1,1,'L');
                
                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(45,5,'3. DATE OF BIRTH','LT',0,'L',true);
                $this->SetTextColor(0,0,255);
                $date=date_create($data->dob);
                $this->Cell(40,5,date_format($date,"m/d/Y"),'LRT',0,'L');

                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(50,5,'16. CITIZENSHIP','LRT',0,'L',true);

                if($data->is_filipino == "yes")
                $check = "3"; else $check = "";
                $this->SetFont('ZapfDingbats','', 12);
                $this->SetTextColor(0,0,255);
                $this->Cell(1,5," ".$check, 0, 0);
                $this->SetTextColor(0,0,0);
                $this->SetFont('ZapfDingbats','', 10);
                $this->Cell(1,5, "r",0, 0);
                $this->SetFont('Arial','',7);
                $this->SetTextColor(0,0,0);
                $this->Cell(4);
                $this->Cell(1,5,"Filipino",0, 0);

                $this->Cell(10);
                if($data->is_filipino == "no")
                //if($data->dual_birth == "1" || $data->dual_naturalization == "1")
                $check = "3"; else $check = "";
                $this->SetFont('ZapfDingbats','', 12);
                $this->SetTextColor(0,0,255);
                $this->Cell(1,5," ".$check, 0, 0);
                $this->SetTextColor(0,0,0);
                $this->SetFont('ZapfDingbats','', 10);
                $this->Cell(1,5, "r",0, 0);
                $this->SetFont('Arial','',7);
                $this->SetTextColor(0,0,0);
                $this->Cell(4);
                $this->Cell(37,5,"Dual Citizenship","R", 1);

                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(45,5,'   (mm/dd/yyyy)','LB',0,'L',true);                
                $this->Cell(40,5,"",'LRB',0,'C');
                
                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(50,5,'If holder of  dual citizenship, ','LR',0,'L',true);

                $this->Cell(20);
                if($data->dual_birth == "1")
                $check = "3"; else $check = "";
                $this->SetFont('ZapfDingbats','', 12);
                $this->SetTextColor(0,0,255);
                $this->Cell(1,5," ".$check, 0, 0);
                $this->SetTextColor(0,0,0);
                $this->SetFont('ZapfDingbats','', 10);
                $this->Cell(1,5, "r",0, 0);
                $this->SetFont('Arial','',7);
                $this->SetTextColor(0,0,0);
                $this->Cell(2);
                $this->Cell(1,5,"by birth",0, 0);

                $this->Cell(10);
                if($data->dual_naturalization == "1")
                $check = "3"; else $check = "";
                $this->SetFont('ZapfDingbats','', 12);
                $this->SetTextColor(0,0,255);
                $this->Cell(1,5," ".$check, 0, 0);
                $this->SetTextColor(0,0,0);
                $this->SetFont('ZapfDingbats','', 10);
                $this->Cell(1,5, "r",0, 0);
                $this->SetFont('Arial','',7);
                $this->SetTextColor(0,0,0);
                $this->Cell(2);
                $this->Cell(21,5,"by naturalization","R", 1,1);

                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(45,5,'4. PLACE OF BIRTH',1,0,'L',true);
                $this->SetTextColor(0,0,255);                
                //$this->Cell(40,5,strtoupper($data->pob),1,0,'C');

                //PLACE OF BIRTH
                $pobLen = strlen($data->pob);
                if($pobLen > 48 ){
                    $this->SetFont('Arial','',3);
                }
                if($pobLen < 24 ){ 
                    $this->Cell(40,5,strtoupper($data->pob),1,0,'C');
                }else{
                    $this->SetFont('Arial','',4); 
                    $this->Cell(40,5,strtoupper($data->pob),1,0,'C');
                    //$this->MultiCell(15,3,strtoupper($data->e_level),1,'C');   
                    //$x = $this->GetX();
                    //$y = $this->GetY();
                    //$this->SetXY($x + 85, $y-6);                 
                }

                $this->SetFont('Arial','',7);
                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(50,5,'please indicate the details. ','LR',0,'L',true);
                $this->Cell(60,5,"Pls. indicate country:", "R",1,'C');

                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(45,5,'5. SEX',1,0,'L',true);
                
                
                if($data->sex == "male")
                $check = "3"; else $check = "";
                $this->SetFont('ZapfDingbats','', 12);
                $this->SetTextColor(0,0,255);
                //$this->Cell(5);
                $this->Cell(1,5," ".$check, 'B', 0);
                $this->SetTextColor(0,0,0);
                $this->SetFont('ZapfDingbats','', 10);
                $this->Cell(4,5, "r",'B', 0);
                $this->SetFont('Arial','',7);
                $this->SetTextColor(0,0,0);                ;
                $this->Cell(10,5,"Male",'B', 0);
                
                if($data->sex == "female")
                $check = "3"; else $check = "";
                $this->SetFont('ZapfDingbats','', 12);
                $this->SetTextColor(0,0,255);
                $this->Cell(1,5," ".$check, 'B', 0);
                $this->SetTextColor(0,0,0);
                $this->SetFont('ZapfDingbats','', 10);
                $this->Cell(4,5, "r",'B', 0);
                $this->SetFont('Arial','',7);
                $this->SetTextColor(0,0,0);                
                $this->Cell(20,5,"Female","RB", 0,1);


                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(50,5,'','LRB',0,'L',true);

                $this->SetTextColor(0,0,255);
                $this->Cell(60,5,strtoupper($data->country_name), "RB",1,'C');

                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(45,5,'6. CIVIL STATUS','LTR',0,'L',true);

                if($data->civilstatus == "single")
                $check = "3"; else $check = "";
                $this->SetFont('ZapfDingbats','', 12);
                $this->SetTextColor(0,0,255);
                //$this->Cell(5);
                $this->Cell(1,5," ".$check,0 , 0);
                $this->SetTextColor(0,0,0);
                $this->SetFont('ZapfDingbats','', 10);
                $this->Cell(4,5, "r",0, 0);
                $this->SetFont('Arial','',7);
                $this->SetTextColor(0,0,0);                ;
                $this->Cell(10,5,"Single",0, 0);
                
                if($data->civilstatus == "married")
                $check = "3"; else $check = "";
                $this->SetFont('ZapfDingbats','', 12);
                $this->SetTextColor(0,0,255);
                $this->Cell(1,5," ".$check, 0, 0);
                $this->SetTextColor(0,0,0);
                $this->SetFont('ZapfDingbats','', 10);
                $this->Cell(4,5, "r",0, 0);
                $this->SetFont('Arial','',7);
                $this->SetTextColor(0,0,0);                
                $this->Cell(20,5,"Married","R", 0,1);

                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(40,5,'17. RESIDENTIAL ADDRESS','LRT',0,'L',true);

                //$this->SetTextColor(0,0,255);
                //$this->Cell(40,5,$data->country,0,0,'C');
            }

        }                 
       
    } 
    
    function address1($db){
        if(isset($_GET['emp_no'])){
            $user_id = $_GET['emp_no'];            
            $stmt = $db->query("SELECT * FROM address WHERE emp_no='$user_id'");            
            while($data = $stmt->fetch(PDO::FETCH_OBJ)){  
                $this->SetFont('Arial','',7);
                $this->SetTextColor(0,0,255);
                $this->Cell(35,5,strtoupper($data->r_hbl_no),0,0,'C');
                $this->Cell(35,5,strtoupper($data->r_st_pur),'R',1,'C');
            }

        }                 
       
    }

    function personalInfo2($db){

        if(isset($_GET['emp_no'])){
            $user_id = $_GET['emp_no'];            
            $stmt = $db->query("SELECT * FROM personal_info WHERE emp_no='$user_id'");            
            while($data = $stmt->fetch(PDO::FETCH_OBJ)){              

                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(45,5,'','LR',0,'L',true);

                if($data->civilstatus == "widowed")
                $check = "3"; else $check = "";
                $this->SetFont('ZapfDingbats','', 12);
                $this->SetTextColor(0,0,255);
                //$this->Cell(5);
                $this->Cell(1,5," ".$check,0 , 0);
                $this->SetTextColor(0,0,0);
                $this->SetFont('ZapfDingbats','', 10);
                $this->Cell(4,5, "r",0, 0);
                $this->SetFont('Arial','',7);
                $this->SetTextColor(0,0,0);
                $this->Cell(10,5,"Widowed",0, 0);
                
                if($data->civilstatus == "separated")
                $check = "3"; else $check = "";
                $this->SetFont('ZapfDingbats','', 12);
                $this->SetTextColor(0,0,255);
                $this->Cell(1,5," ".$check, 0, 0);
                $this->SetTextColor(0,0,0);
                $this->SetFont('ZapfDingbats','', 10);
                $this->Cell(4,5, "r",0, 0);
                $this->SetFont('Arial','',7);
                $this->SetTextColor(0,0,0);                
                $this->Cell(20,5,"Separated","R", 0,1);

                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(40,5,'','LR',0,'L',true);
                
                $this->SetFont('Arial','',6);
                $this->Cell(35,3,'House/Block/Lot No.','B',0,'C');                
                $this->Cell(35,3,'Street','BR',1,'C');

                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(45,5,'','LR',0,'L',true);
                
                if($data->civilstatus == "others")
                $check = "3"; else $check = "";
                $this->SetFont('ZapfDingbats','', 12);
                $this->SetTextColor(0,0,255);
                $this->Cell(1,5," ".$check,0 , 0);
                $this->SetTextColor(0,0,0);
                $this->SetFont('ZapfDingbats','', 10);
                $this->Cell(4,5, "r",0, 0);
                $this->SetFont('Arial','',7);
                $this->SetTextColor(0,0,0);
                $this->Cell(35,5,"Other/s:",'R', 0);
                
                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(40,5,'','LR',0,'L',true);
            }
        }
    }

    function address2($db){
        if(isset($_GET['emp_no'])){
            $user_id = $_GET['emp_no'];            
            $stmt = $db->query("SELECT * FROM address WHERE emp_no='$user_id'");            
            while($data = $stmt->fetch(PDO::FETCH_OBJ)){  
                $this->SetFont('Arial','',7);
                $this->SetTextColor(0,0,255);
                $this->Cell(35,5,strtoupper($data->r_sub_vil),0,0,'C');
                $this->Cell(35,5,strtoupper($data->r_brgy),'R',1,'C');
            }
        } 
    }

    function personalInfo3($db){

        if(isset($_GET['emp_no'])){
            $user_id = $_GET['emp_no'];            
            $stmt = $db->query("SELECT * FROM personal_info WHERE emp_no='$user_id'");            
            while($data = $stmt->fetch(PDO::FETCH_OBJ)){              

                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(45,3,'','LR',0,'L',true);
                
                $this->SetTextColor(0,0,255); 
                $this->Cell(40,3,strtoupper($data->others),'R', 0,'C');

                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(40,3,'','LR',0,'L',true);
                
                $this->SetFont('Arial','',6);
                $this->Cell(35,3,'Subdivision/Village','B',0,'C');                
                $this->Cell(35,3,'Barangay','BR',1,'C');

                $this->SetFont('Arial','',7);
                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(45,5,'7. HEIGHT (m)','LTR',0,'L',true);
                $this->SetTextColor(0,0,255);                
                $this->Cell(40,5,$data->height,'TR',0,'L');

                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(40,5,'','LR',0,'L',true);
                
            }
        }
    }

    function address3($db){
        if(isset($_GET['emp_no'])){
            $user_id = $_GET['emp_no'];            
            $stmt = $db->query("SELECT * FROM address WHERE emp_no='$user_id'");            
            while($data = $stmt->fetch(PDO::FETCH_OBJ)){  
                $this->SetFont('Arial','',7);
                $this->SetTextColor(0,0,255);
                $this->Cell(35,5,strtoupper($data->r_city_mun),0,0,'C');
                $this->Cell(35,5,strtoupper($data->r_prov),'R',1,'C');
            }
        } 
    }

    function personalInfo4($db){

        if(isset($_GET['emp_no'])){
            $user_id = $_GET['emp_no'];            
            $stmt = $db->query("SELECT * FROM personal_info WHERE emp_no='$user_id'");            
            while($data = $stmt->fetch(PDO::FETCH_OBJ)){              

                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(45,3,'','LR',0,'L',true);
                
                $this->Cell(40,3,'','R', 0);

                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(40,3,'','LR',0,'L',true);
                
                $this->SetFont('Arial','',6);
                $this->Cell(35,3,'City/Municipality','B',0,'C');                
                $this->Cell(35,3,'Province','BR',1,'C');

                $this->SetFont('Arial','',7);
                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(45,5,'8. WEIGHT (kg)',1,0,'L',true);
                $this->SetTextColor(0,0,255);                
                $this->Cell(40,5,$data->weight,1,0,'L');

                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(40,5,'ZIP CODE','LBR',0,'C',true);
                
            }
        }
    }

    function address4($db){
        if(isset($_GET['emp_no'])){
            $user_id = $_GET['emp_no'];            
            $stmt = $db->query("SELECT * FROM address WHERE emp_no='$user_id'");            
            while($data = $stmt->fetch(PDO::FETCH_OBJ)){  
                $this->SetFont('Arial','',7);
                $this->SetTextColor(0,0,255);                
                $this->Cell(70,5,strtoupper($data->r_zip),'BR',1,'C');
            }
        } 
    }

    function personalInfo5($db){

        if(isset($_GET['emp_no'])){
            $user_id = $_GET['emp_no'];            
            $stmt = $db->query("SELECT * FROM personal_info WHERE emp_no='$user_id'");            
            while($data = $stmt->fetch(PDO::FETCH_OBJ)){  

                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(45,5,'9. BLOOD TYPE','LTR',0,'L',true);
                $this->SetTextColor(0,0,255);                
                $this->Cell(40,5,strtoupper('"'.$data->bloodtype).'"','TR',0,'L');

                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(40,5,'18. PERMANENT ADDRESS','LRT',0,'L',true);
                
            }
        }
    }

    function address5($db){
        if(isset($_GET['emp_no'])){
            $user_id = $_GET['emp_no'];            
            $stmt = $db->query("SELECT * FROM address WHERE emp_no='$user_id'");            
            while($data = $stmt->fetch(PDO::FETCH_OBJ)){  
                $this->SetFont('Arial','',7);
                $this->SetTextColor(0,0,255);
                $this->Cell(35,5,strtoupper($data->p_hbl_no),0,0,'C');
                $this->Cell(35,5,strtoupper($data->p_st_pur),'R',1,'C');
            }
        } 
    }

    function personalInfo6($db){

        if(isset($_GET['emp_no'])){
            $user_id = $_GET['emp_no'];            
            $stmt = $db->query("SELECT * FROM personal_info WHERE emp_no='$user_id'");            
            while($data = $stmt->fetch(PDO::FETCH_OBJ)){              

                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(45,3,'','LR',0,'L',true);
                
                $this->Cell(40,3,'','R', 0);

                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(40,3,'','LR',0,'L',true);
                
                $this->SetFont('Arial','',6);
                $this->Cell(35,3,'House/Block/Lot No.','B',0,'C');                
                $this->Cell(35,3,'Street','BR',1,'C');

                $this->SetFont('Arial','',7);
                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(45,5,'10. GSIS ID NO.','LTR',0,'L',true);
                $this->SetTextColor(0,0,255);                
                $this->Cell(40,5,$data->gsis_no,'TR',0,'L');

                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(40,5,'','LR',0,'L',true);
                
            }
        }
    }

    function address6($db){
        if(isset($_GET['emp_no'])){
            $user_id = $_GET['emp_no'];            
            $stmt = $db->query("SELECT * FROM address WHERE emp_no='$user_id'");            
            while($data = $stmt->fetch(PDO::FETCH_OBJ)){  
                $this->SetFont('Arial','',7);
                $this->SetTextColor(0,0,255);
                $this->Cell(35,5,strtoupper($data->p_sub_vil),0,0,'C');
                $this->Cell(35,5,strtoupper($data->p_brgy),'R',1,'C');
            }
        } 
    }

    function personalInfo7($db){

        if(isset($_GET['emp_no'])){
            $user_id = $_GET['emp_no'];            
            $stmt = $db->query("SELECT * FROM personal_info WHERE emp_no='$user_id'");            
            while($data = $stmt->fetch(PDO::FETCH_OBJ)){              

                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(45,3,'','LR',0,'L',true);
                
                $this->Cell(40,3,'','R', 0);

                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(40,3,'','LR',0,'L',true);
                
                $this->SetFont('Arial','',6);
                $this->Cell(35,3,'Subdivision/Village','B',0,'C');                
                $this->Cell(35,3,'Barangay','BR',1,'C');

                $this->SetFont('Arial','',7);
                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(45,5,'11. PAG-IBIG ID NO.','LTR',0,'L',true);
                $this->SetTextColor(0,0,255);                
                $this->Cell(40,5,$data->pagibig_no,'TR',0,'L');

                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(40,5,'','LR',0,'L',true);
                
            }
        }
    }

    function address7($db){
        if(isset($_GET['emp_no'])){
            $user_id = $_GET['emp_no'];            
            $stmt = $db->query("SELECT * FROM address WHERE emp_no='$user_id'");            
            while($data = $stmt->fetch(PDO::FETCH_OBJ)){  
                $this->SetFont('Arial','',7);
                $this->SetTextColor(0,0,255);
                $this->Cell(35,5,strtoupper($data->p_city_mun),0,0,'C');
                $this->Cell(35,5,strtoupper($data->p_prov),'R',1,'C');
            }
        } 
    }

    function personalInfo8($db){

        if(isset($_GET['emp_no'])){
            $user_id = $_GET['emp_no'];            
            $stmt = $db->query("SELECT * FROM personal_info WHERE emp_no='$user_id'");            
            while($data = $stmt->fetch(PDO::FETCH_OBJ)){              

                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(45,3,'','LR',0,'L',true);
                
                $this->Cell(40,3,'','R', 0);

                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(40,3,'','LR',0,'L',true);
                
                $this->SetFont('Arial','',6);
                $this->Cell(35,3,'City/Municipality','B',0,'C');                
                $this->Cell(35,3,'Province','BR',1,'C');

                $this->SetFont('Arial','',7);
                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(45,5,'12. PHILHEALTH NO.',1,0,'L',true);
                $this->SetTextColor(0,0,255);                
                $this->Cell(40,5,$data->philhealth_no,1,0,'L');

                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(40,5,'ZIP CODE','LBR',0,'C',true);
                
            }
        }
    }

    function address8($db){
        if(isset($_GET['emp_no'])){
            $user_id = $_GET['emp_no'];            
            $stmt = $db->query("SELECT * FROM address WHERE emp_no='$user_id'");            
            while($data = $stmt->fetch(PDO::FETCH_OBJ)){  
                $this->SetFont('Arial','',7);
                $this->SetTextColor(0,0,255);                
                $this->Cell(70,5,strtoupper($data->p_zip),'BR',1,'C');
            }
        } 
    }

    function personalInfo9($db){

        if(isset($_GET['emp_no'])){
            $user_id = $_GET['emp_no'];            
            $stmt = $db->query("SELECT * FROM personal_info WHERE emp_no='$user_id'");            
            while($data = $stmt->fetch(PDO::FETCH_OBJ)){              

                $this->SetFont('Arial','',7);
                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(45,5,'13. SSS NO.',1,0,'L',true);
                $this->SetTextColor(0,0,255);                
                $this->Cell(40,5,$data->sss_no,1,0,'L');

                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(40,5,'19. TELEPHONE NO.',1,0,'L',true);
                $this->SetTextColor(0,0,255);                
                $this->Cell(70,5,strtoupper($data->telephone),'BR',1,'L');

                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(45,5,'14. TIN NO.',1,0,'L',true);
                $this->SetTextColor(0,0,255);                
                $this->Cell(40,5,$data->tin_no,1,0,'L');

                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(40,5,'20. MOBILE NO.',1,0,'L',true);
                $this->SetTextColor(0,0,255);                
                $this->Cell(70,5,strtoupper($data->mobile),'BR',1,'L');

                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(45,5,'15. AGENCY EMPLOYEE NO.',1,0,'L',true);
                $this->SetTextColor(0,0,255);                
                $this->Cell(40,5,$data->emp_no,1,0,'L');

                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(40,5,'21. E-MAIL ADDRESS (if any)',1,0,'L',true);
                $this->SetTextColor(0,0,255);                
                $this->Cell(70,5,$data->email,'BR',1,'L');
                
            }
        }
    }
   
    function familybackground($db){        

        if(isset($_GET['emp_no'])){
            $user_id = $_GET['emp_no'];  
            $child = array();
            $dob = array();
            $stmt1 = $db->query("SELECT * FROM children WHERE emp_no='$user_id'");            
            while($data1 = $stmt1->fetch(PDO::FETCH_OBJ)){
                $name = $data1->child_name;
                $bday = $data1->child_dob;
                array_push($child,$name);
                array_push($dob,$bday);
            }

            $count = count($child);
            //echo $count;
            for($x = $count; $x < 12; $x++){
                $child[$x]="";
                $dob[$x]=null;
            }
            
            $stmt = $db->query("SELECT * FROM family_background WHERE emp_no='$user_id'");            
            while($data = $stmt->fetch(PDO::FETCH_OBJ)){                
    
                $this->SetFont('Arial','I',10);
                $this->SetFillColor(115,115,115);
                $this->SetTextColor(255,255,255);
                $this->Cell(195,5,'II. FAMILY BACKGROUND',1,1,'L',true);
                
                $this->SetFont('Arial','',7);
                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(45,5,"22. SPOUSE'S SURNAME",'TL',0,'L',true);
                $this->SetTextColor(0,0,255);
                $this->Cell(80,5,strtoupper($data->spouse_lastname),1,0,'L');
               
                $this->SetFont('Arial','',4.5);
                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);                
                $this->Cell(45,5,'23. NAME of CHILDREN  (Write full name and list all)',1,0,'L',true);
                
                $this->SetFont('Arial','',4.5);
                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);                
                $this->Cell(25,5,'DATE OF BIRTH (mm/dd/yyyy) ',1,1,'C',true);
                
                $this->SetFont('Arial','',7);
                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(45,5,'      FIRST NAME','L',0,'L',true);
                $this->SetTextColor(0,0,255);
                $this->Cell(40,5,strtoupper($data->spouse_firstname),1,0,'L');

                $this->SetFont('Arial','',6);
                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);                
                $this->Cell(30,5,'NAME EXTENSION (JR., SR)  ','TLB',0,'L',true);
                $this->SetTextColor(0,0,255);
                $this->Cell(10,5,strtoupper($data->spouse_exname),'TRB',0,'L',true);

                //###### CHILD ############
                $this->SetFont('Arial','',6);                
                $this->SetTextColor(0,0,255);                
                $this->Cell(45,5,strtoupper($child[0]),1,0,'L');
                
                if($count<=0){
                    $this->SetTextColor(0,0,255);                                   
                    $this->Cell(25,5,"",1,1,'C');
                }else{
                    if($dob[0]=="N/A"){
                        $this->SetTextColor(0,0,255);
                        $this->Cell(25,5,$dob[0],1,1,'L');
                    }else{
                        $this->SetTextColor(0,0,255);               
                        $date2=date_create($dob[0]);                
                        $this->Cell(25,5,date_format($date2,"m/d/Y"),1,1,'L');
                    }
                } 
                           
                
                $this->SetFont('Arial','',7);
                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(45,5,'      MIDDLE NAME','L',0,'L',true);
                $this->SetTextColor(0,0,255);
                $this->Cell(80,5,strtoupper($data->spouse_middlename),1,0,'L');

                //###### CHILD ############
                $this->SetFont('Arial','',6);                
                $this->SetTextColor(0,0,255);
                $this->Cell(45,5,strtoupper($child[1]),1,0,'L');
                               
                if($count<=1){
                    $this->SetTextColor(0,0,255);                                   
                    $this->Cell(25,5,"",1,1,'C');
                }else{
                    if($dob[0]=="N/A"){
                        $this->SetTextColor(0,0,255);
                        $this->Cell(25,5,$dob[0],1,1,'L');
                    }else{
                        $this->SetTextColor(0,0,255);               
                        $date2=date_create($dob[1]);                
                        $this->Cell(25,5,date_format($date2,"m/d/Y"),1,1,'L');
                    }
                } 

                $this->SetFont('Arial','',7);
                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(45,5,'      OCCUPATION',1,0,'L',true);
                $this->SetTextColor(0,0,255);
                $this->Cell(80,5,strtoupper($data->spouse_occupation),1,0,'L');

                //###### CHILD ############
                $this->SetFont('Arial','',6);                
                $this->SetTextColor(0,0,255);
                $this->Cell(45,5,strtoupper($child[2]),1,0,'L');
                               
                if($count<=2){
                    $this->SetTextColor(0,0,255);                                   
                    $this->Cell(25,5,"",1,1,'C');
                }else{
                    if($dob[0]=="N/A"){
                        $this->SetTextColor(0,0,255);
                        $this->Cell(25,5,$dob[0],1,1,'L');
                    }else{
                        $this->SetTextColor(0,0,255);               
                        $date2=date_create($dob[2]);                
                        $this->Cell(25,5,date_format($date2,"m/d/Y"),1,1,'L');
                    }
                } 

                $this->SetFont('Arial','',7);
                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(45,5,'      EMPLOYER/BUSINESS NAME',1,0,'L',true);
                $this->SetTextColor(0,0,255);
                $this->Cell(80,5,strtoupper($data->spouse_employer),1,0,'L');

                //###### CHILD ############
                $this->SetFont('Arial','',6);                
                $this->SetTextColor(0,0,255);
                $this->Cell(45,5,strtoupper($child[3]),1,0,'L');
                               
                if($count<=3){
                    $this->SetTextColor(0,0,255);                                   
                    $this->Cell(25,5,"",1,1,'C');
                }else{
                    if($dob[0]=="N/A"){
                        $this->SetTextColor(0,0,255);
                        $this->Cell(25,5,$dob[0],1,1,'L');
                    }else{
                        $this->SetTextColor(0,0,255);               
                        $date2=date_create($dob[3]);                
                        $this->Cell(25,5,date_format($date2,"m/d/Y"),1,1,'L');
                    }
                } 

                $this->SetFont('Arial','',7);
                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(45,5,'      BUSINESS ADDRESS',1,0,'L',true);
                $this->SetTextColor(0,0,255);
                $this->Cell(80,5,strtoupper($data->spouse_buss_add),1,0,'L');

                //###### CHILD ############
                $this->SetFont('Arial','',6);                
                $this->SetTextColor(0,0,255);
                $this->Cell(45,5,strtoupper($child[4]),1,0,'L');
                
                if($count<=4){
                    $this->SetTextColor(0,0,255);                                   
                    $this->Cell(25,5,"",1,1,'C');
                }else{
                    if($dob[0]=="N/A"){
                        $this->SetTextColor(0,0,255);
                        $this->Cell(25,5,$dob[0],1,1,'L');
                    }else{
                        $this->SetTextColor(0,0,255);               
                        $date2=date_create($dob[4]);                
                        $this->Cell(25,5,date_format($date2,"m/d/Y"),1,1,'L');
                    }
                } 

                $this->SetFont('Arial','',7);
                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(45,5,'      TELEPHONE NO.',1,0,'L',true);
                $this->SetTextColor(0,0,255);
                $this->Cell(80,5,strtoupper($data->spouse_buss_tel),1,0,'L');

                //###### CHILD ############
                $this->SetFont('Arial','',6);                
                $this->SetTextColor(0,0,255);
                $this->Cell(45,5,strtoupper($child[5]),1,0,'L');
                               
                if($count<=5){
                    $this->SetTextColor(0,0,255);                                   
                    $this->Cell(25,5,"",1,1,'C');
                }else{
                    if($dob[0]=="N/A"){
                        $this->SetTextColor(0,0,255);
                        $this->Cell(25,5,$dob[0],1,1,'L');
                    }else{
                        $this->SetTextColor(0,0,255);               
                        $date2=date_create($dob[5]);                
                        $this->Cell(25,5,date_format($date2,"m/d/Y"),1,1,'L');
                    }
                } 

                $this->SetFont('Arial','',7);
                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(45,5,"24. FATHER'S SURNAME",'TL',0,'L',true);
                $this->SetTextColor(0,0,255);
                $this->Cell(80,5,strtoupper($data->father_lastname),1,0,'L');
               
                //###### CHILD ############
                $this->SetFont('Arial','',6);                
                $this->SetTextColor(0,0,255);
                $this->Cell(45,5,strtoupper($child[6]),1,0,'L');
                               
                if($count<=6){
                    $this->SetTextColor(0,0,255);                                   
                    $this->Cell(25,5,"",1,1,'C');
                }else{
                    if($dob[0]=="N/A"){
                        $this->SetTextColor(0,0,255);
                        $this->Cell(25,5,$dob[0],1,1,'L');
                    }else{
                        $this->SetTextColor(0,0,255);               
                        $date2=date_create($dob[6]);                
                        $this->Cell(25,5,date_format($date2,"m/d/Y"),1,1,'L');
                    }
                }
                
                $this->SetFont('Arial','',7);
                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(45,5,'      FIRST NAME','L',0,'L',true);
                $this->SetTextColor(0,0,255);
                $this->Cell(40,5,strtoupper($data->father_firstname),1,0,'L');

                $this->SetFont('Arial','',6);
                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);                
                $this->Cell(30,5,'NAME EXTENSION (JR., SR)  ','TLB',0,'L',true);
                $this->SetTextColor(0,0,255);
                $this->Cell(10,5,strtoupper($data->father_exname),'TRB',0,'L',true);

                //###### CHILD ############
                $this->SetFont('Arial','',6);                
                $this->SetTextColor(0,0,255);
                $this->Cell(45,5,strtoupper($child[7]),1,0,'L');
                               
                if($count<=7){
                    $this->SetTextColor(0,0,255);                                   
                    $this->Cell(25,5,"",1,1,'C');
                }else{
                    if($dob[0]=="N/A"){
                        $this->SetTextColor(0,0,255);
                        $this->Cell(25,5,$dob[0],1,1,'L');
                    }else{
                        $this->SetTextColor(0,0,255);               
                        $date2=date_create($dob[7]);                
                        $this->Cell(25,5,date_format($date2,"m/d/Y"),1,1,'L');
                    }
                }
                
                $this->SetFont('Arial','',7);
                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(45,5,'      MIDDLE NAME','L',0,'L',true);
                $this->SetTextColor(0,0,255);
                $this->Cell(80,5,strtoupper($data->father_middlename),1,0,'L');

                //###### CHILD ############
                $this->SetFont('Arial','',6);                
                $this->SetTextColor(0,0,255);
                $this->Cell(45,5,strtoupper($child[8]),1,0,'L');
                               
                if($count<=8){
                    $this->SetTextColor(0,0,255);                                   
                    $this->Cell(25,5,"",1,1,'C');
                }else{
                    if($dob[0]=="N/A"){
                        $this->SetTextColor(0,0,255);
                        $this->Cell(25,5,$dob[0],1,1,'L');
                    }else{
                        $this->SetTextColor(0,0,255);               
                        $date2=date_create($dob[8]);                
                        $this->Cell(25,5,date_format($date2,"m/d/Y"),1,1,'L');
                    }
                }

                $this->SetFont('Arial','',7);
                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(45,5,"25. MOTHER'S MAIDEN NAME",'TL',0,'L',true);
                $this->SetTextColor(0,0,255);
                $this->Cell(80,5,'',1,0,'L',true);
               
                //###### CHILD ############
                $this->SetFont('Arial','',6);                
                $this->SetTextColor(0,0,255);
                $this->Cell(45,5,strtoupper($child[9]),1,0,'L');
                               
                if($count<=9){
                    $this->SetTextColor(0,0,255);                                   
                    $this->Cell(25,5,"",1,1,'C');
                }else{
                    if($dob[0]=="N/A"){
                        $this->SetTextColor(0,0,255);
                        $this->Cell(25,5,$dob[0],1,1,'L');
                    }else{
                        $this->SetTextColor(0,0,255);               
                        $date2=date_create($dob[9]);                
                        $this->Cell(25,5,date_format($date2,"m/d/Y"),1,1,'L');
                    }
                }
                

                $this->SetFont('Arial','',7);
                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(45,5,'      SURNAME','L',0,'L',true);
                $this->SetTextColor(0,0,255);
                $this->Cell(80,5,strtoupper($data->mother_lastname),1,0,'L');

                //###### CHILD ############
                $this->SetFont('Arial','',6);                
                $this->SetTextColor(0,0,255);
                $this->Cell(45,5,strtoupper($child[10]),1,0,'L');
                               
                if($count<=10){
                    $this->SetTextColor(0,0,255);                                   
                    $this->Cell(25,5,"",1,1,'C');
                }else{
                    if($dob[0]=="N/A"){
                        $this->SetTextColor(0,0,255);
                        $this->Cell(25,5,$dob[0],1,1,'L');
                    }else{
                        $this->SetTextColor(0,0,255);               
                        $date2=date_create($dob[10]);                
                        $this->Cell(25,5,date_format($date2,"m/d/Y"),1,1,'L');
                    }
                }


                $this->SetFont('Arial','',7);
                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(45,5,'      FIRST NAME','L',0,'L',true);
                $this->SetTextColor(0,0,255);
                $this->Cell(80,5,strtoupper($data->mother_firstname),1,0,'L');

                //###### CHILD ############
                $this->SetFont('Arial','',6);                
                $this->SetTextColor(0,0,255);
                $this->Cell(45,5,strtoupper($child[11]),1,0,'L');
                               
                if($count<=11){
                    $this->SetTextColor(0,0,255);                                   
                    $this->Cell(25,5,"",1,1,'C');
                }else{
                    if($dob[0]=="N/A"){
                        $this->SetTextColor(0,0,255);
                        $this->Cell(25,5,$dob[0],1,1,'L');
                    }else{
                        $this->SetTextColor(0,0,255);               
                        $date2=date_create($dob[11]);                
                        $this->Cell(25,5,date_format($date2,"m/d/Y"),1,1,'L');
                    }
                }
                
                $this->SetFont('Arial','',7);
                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(45,5,'      MIDDLE NAME','BL',0,'L',true);
                $this->SetTextColor(0,0,255);
                $this->Cell(80,5,strtoupper($data->mother_middlename),1,0,'L');

                $this->SetFont('Arial','I',6);
                $this->SetTextColor(255,0,0);
                $this->SetFillColor(194,194,194);                
                $this->Cell(70,5,'(Continue on separate sheet if necessary)',1,1,'C',true);         

               
            }

        }                 
       
    } 

    function educationalbackground($db){

        if(isset($_GET['emp_no'])){
            $user_id = $_GET['emp_no']; 

            $this->SetFont('Arial','I',10);
            $this->SetFillColor(115,115,115);
            $this->SetTextColor(255,255,255);
            $this->Cell(195,5,'III.  EDUCATIONAL BACKGROUND',1,1,'L',true);

            $this->SetFont('Arial','',4);
            $this->SetTextColor(0,0,0);
            $this->SetFillColor(194,194,194);
            $this->Cell(45,2,"",'TL',0,'L',true);
            $this->Cell(45,2,"",'TL',0,'L',true);
            $this->Cell(40,2,"",'TL',0,'L',true);
            $this->Cell(20,2,"",'TL',0,'L',true);
            $this->Cell(15,2,"",'TL',0,'L',true);
            $this->Cell(15,2,"",'TL',0,'L',true);
            $this->Cell(15,2,"SCHOLARSHIP/",'TLR',1,'C',true);
            
            $this->SetFont('Arial','',7);
            $this->SetTextColor(0,0,0);
            $this->SetFillColor(194,194,194);
            $this->Cell(45,3,"26.",'L',0,'L',true);

            $this->SetFont('Arial','',5);
            $this->Cell(45,3,"NAME OF SCHOOL",'LR',0,'C',true);
            $this->Cell(40,3,"BASIC EDUCATION/DEGREE/COURSE",'LR',0,'C',true);
            $this->SetFont('Arial','',4);
            $this->Cell(20,3,"PERIOD OF ATTENDANCE",'LR',0,'C',true);            
            $this->Cell(15,3,"HIGHEST LEVEL/",'LR',0,'C',true);
            $this->Cell(15,3,"YEAR",'LR',0,'C',true);
            $this->Cell(15,3,"ACADEMIC",'LR',1,'C',true);

            $this->SetFont('Arial','',7);
            $this->Cell(45,2,"LEVEL",'L',0,'C',true);

            $this->SetFont('Arial','',4);
            $this->Cell(45,2,"(Write in full)",'LR',0,'C',true);
            $this->Cell(40,2,"(Write in full)",'LR',0,'C',true);
            $this->Cell(20,2,"",'LR',0,'C',true);
            $this->Cell(15,2,"UNITS EARNED",'LR',0,'C',true);
            $this->Cell(15,2,"GRADUATED",'LR',0,'C',true);
            $this->Cell(15,2,"HONORS",'LR',1,'C',true);
            
            $this->Cell(45,3,"",'BL',0,'L',true);
            $this->Cell(45,3,"",'BL',0,'L',true);
            $this->Cell(40,3,"",'BL',0,'L',true);
            $this->Cell(10,3,"From",1,0,'C',true);
            $this->Cell(10,3,"To",1,0,'C',true);
            $this->Cell(15,3,"",'BL',0,'L',true);
            $this->Cell(15,3,"",'BL',0,'L',true);
            $this->Cell(15,3,"RECEIVED",'BLR',1,'C',true);

            $stmt = $db->query("SELECT * FROM educational WHERE emp_no='$user_id' AND educational_level='elementary' ");            
            while($data = $stmt->fetch(PDO::FETCH_OBJ)){
            
                $this->SetFont('Arial','',7);
                $this->SetTextColor(0,0,0);
                $this->Cell(45,6,"ELEMENTARY",1,0,'C',true);
                $this->SetTextColor(0,0,255);
                $this->SetFont('Arial','',5);

                $course_name = strlen($data->e_nameofschool);
                if($course_name > 76 ){
                    $this->SetFont('Arial','',4);
                }
                if($course_name < 40 ){
                    $this->Cell(45,6,strtoupper($data->e_nameofschool),1,0,'C');
                }else{                    
                    $this->MultiCell(45,3,strtoupper($data->e_nameofschool),1,'C');
                    $x = $this->GetX();
                    $y = $this->GetY();
                    $this->SetXY($x + 90, $y-6);
                }
                
                $this->SetFont('Arial','',5);
                $this->Cell(40,6,strtoupper($data->e_course),1,0,'C');
                $this->Cell(10,6,strtoupper($data->e_from),1,0,'C');
                $this->Cell(10,6,strtoupper($data->e_to),1,0,'C');
                $this->Cell(15,6,strtoupper($data->e_level),1,0,'C');
                $this->Cell(15,6,strtoupper($data->e_year),1,0,'C');
                
                if(strlen($data->e_scholarship) > 16 ){
                    $this->SetFont('Arial','',4);
                }
                if(strlen($data->e_scholarship) < 10 ){
                    $this->Cell(15,6,strtoupper($data->e_scholarship),1,1,'C');
                }else{
                    $this->MultiCell(15,3,strtoupper($data->e_scholarship),1,'C');
                }

                
                
            }

            $stmt = $db->query("SELECT * FROM educational WHERE emp_no='$user_id' AND educational_level='secondary' ");            
            while($data = $stmt->fetch(PDO::FETCH_OBJ)){
            
                $this->SetFont('Arial','',7);
                $this->SetTextColor(0,0,0);
                $this->Cell(45,6,"SECONDARY",1,0,'C',true);
                $this->SetTextColor(0,0,255);
                $this->SetFont('Arial','',5);                

                $course_name = strlen($data->e_nameofschool);
                if($course_name > 76 ){
                    $this->SetFont('Arial','',4);
                }
                if($course_name < 40 ){
                    $this->Cell(45,6,strtoupper($data->e_nameofschool),1,0,'C');
                }else{
                    //$this->SetFont('Arial','',5);
                    $this->MultiCell(45,3,strtoupper($data->e_nameofschool),1,'C');
                    $x = $this->GetX();
                    $y = $this->GetY();
                    $this->SetXY($x + 90, $y-6);
                }

                $this->SetFont('Arial','',5); 
                $this->Cell(40,6,strtoupper($data->e_course),1,0,'C');
                $this->Cell(10,6,strtoupper($data->e_from),1,0,'C');
                $this->Cell(10,6,strtoupper($data->e_to),1,0,'C');
                $this->Cell(15,6,strtoupper($data->e_level),1,0,'C');
                $this->Cell(15,6,strtoupper($data->e_year),1,0,'C');


                if(strlen($data->e_scholarship) > 16 ){
                    $this->SetFont('Arial','',3.5);
                }                    
                if(strlen($data->e_scholarship) < 10 ){
                    $this->Cell(15,6,strtoupper($data->e_scholarship),1,1,'C');
                }else{
                    //$this->SetFont('Arial','',4);
                    $this->MultiCell(15,3,strtoupper($data->e_scholarship),1,'C');
                }
                
            }

            $stmt = $db->query("SELECT * FROM educational WHERE emp_no='$user_id' AND educational_level='vocational' ");            
            while($data = $stmt->fetch(PDO::FETCH_OBJ)){
            
                $this->SetFont('Arial','',7);
                $this->SetTextColor(0,0,0);
                $this->Cell(45,6,"VOCATIONAL / TRADE COURSE",1,0,'C',true);
                $this->SetTextColor(0,0,255);
                $this->SetFont('Arial','',5);
                //$this->Cell(45,6,strtoupper($data->e_nameofschool),1,0,'C');

                $course_name = strlen($data->e_nameofschool);
                if($course_name > 76 ){
                    $this->SetFont('Arial','',4);
                }
                if($course_name < 40 ){
                    $this->Cell(45,6,strtoupper($data->e_nameofschool),1,0,'C');
                }else{
                    //$this->SetFont('Arial','',5);
                    $this->MultiCell(45,3,strtoupper($data->e_nameofschool),1,'C');
                    $x = $this->GetX();
                    $y = $this->GetY();
                    $this->SetXY($x + 90, $y-6);
                }
                     
                
                $this->SetFont('Arial','',5);
                $course_len = strlen($data->e_course);
                if($course_len > 76 ){
                    $this->SetFont('Arial','',3);
                }
                //echo $course_len;
                if($course_len < 35 ){
                    $this->Cell(40,6,strtoupper($data->e_course),1,0,'C');
                }else{
                    $this->SetFont('Arial','',5);
                    $this->MultiCell(40,3,strtoupper($data->e_course),1,'C');
                    $x = $this->GetX();
                    $y = $this->GetY();
                    $this->SetXY($x + 130, $y-6);
                }

                $this->SetFont('Arial','',5);
                $this->Cell(10,6,strtoupper($data->e_from),1,0,'C');
                $this->Cell(10,6,strtoupper($data->e_to),1,0,'C');
                $this->Cell(15,6,strtoupper($data->e_level),1,0,'C');
                $this->Cell(15,6,strtoupper($data->e_year),1,0,'C');

                //$this->SetFont('Arial','',5);
                if(strlen($data->e_scholarship) > 16 ){
                    $this->SetFont('Arial','',4);
                } 
                if(strlen($data->e_scholarship) < 10 ){                
                    //$this->SetFont('Arial','',4.5);
                    $this->Cell(15,6,strtoupper($data->e_scholarship),1,1,'C');
                }else{
                    //$this->SetFont('Arial','',4);
                    $this->MultiCell(15,3,strtoupper($data->e_scholarship),1,'C');
                }
                
            }

            $stmt = $db->query("SELECT * FROM educational WHERE emp_no='$user_id' AND educational_level='college' ");            
            while($data = $stmt->fetch(PDO::FETCH_OBJ)){
            
                $this->SetFont('Arial','',7);
                $this->SetTextColor(0,0,0);
                $this->Cell(45,6,"COLLEGE",1,0,'C',true);
                $this->SetTextColor(0,0,255);
                $this->SetFont('Arial','',5);

                $course_name = strlen($data->e_nameofschool);
                
                if($course_name > 76 ){
                    $this->SetFont('Arial','',4);
                }
                if($course_name > 98 ){
                    $this->SetFont('Arial','',3);
                }
                //$this->Cell(45,6,strtoupper($data->e_nameofschool),1,0,'C');
                if($course_name < 40 ){
                    $this->Cell(45,6,strtoupper($data->e_nameofschool),1,0,'C');
                }else{
                    //$this->SetFont('Arial','',5);
                    $this->MultiCell(45,3,strtoupper($data->e_nameofschool),1,'C');
                    $x = $this->GetX();
                    $y = $this->GetY();
                    $this->SetXY($x + 90, $y-6);
                }

                $this->SetFont('Arial','',5);
                $course_len = strlen($data->e_course);
                if($course_len > 70 ){
                    $this->SetFont('Arial','',3);
                }
                //echo $course_len;
                if($course_len < 35 ){
                    $this->Cell(40,6,strtoupper($data->e_course),1,0,'C');
                }else{
                    //$this->SetFont('Arial','',5);
                    $this->MultiCell(40,3,strtoupper($data->e_course),1,'C');
                    $x = $this->GetX();
                    $y = $this->GetY();
                    $this->SetXY($x + 130, $y-6);
                }

                $this->SetFont('Arial','',5);
                $this->Cell(10,6,strtoupper($data->e_from),1,0,'C');
                $this->Cell(10,6,strtoupper($data->e_to),1,0,'C');

                //HIGHEST LEVEL / UNITS EARNED
                if(strlen($data->e_level) > 29 ){
                    $this->SetFont('Arial','',3);
                }
                if(strlen($data->e_level) < 10 ){ 
                    $this->Cell(15,6,strtoupper($data->e_level),1,0,'C');
                }else{
                    //$this->SetFont('Arial','',4); 
                    $this->MultiCell(15,3,strtoupper($data->e_level),1,'C');   
                    $x = $this->GetX();
                    $y = $this->GetY();
                    $this->SetXY($x + 165, $y-6);                 
                }

                $this->SetFont('Arial','',5);
                //$this->Cell(15,6,strtoupper($data->e_level),1,0,'C');
                $this->Cell(15,6,strtoupper($data->e_year),1,0,'C');
                // $x = $this->GetX();
                // $y = $this->GetY();                
                // $this->SetXY($x,$y-5);
                //stripslashes($str);
                //htmlspecialchars($str);
                if(strlen($data->e_scholarship) > 16 ){
                    $this->SetFont('Arial','',4);
                }
                if(strlen($data->e_scholarship) < 10 ){ 
                    //$this->SetFont('Arial','',4.4);
                    $this->Cell(15,6,strtoupper($data->e_scholarship),1,1,'C');
                }else{
                    //$this->SetFont('Arial','',3.5);   
                    $this->MultiCell(15,3,strtoupper($data->e_scholarship),1,'C');
                }
            }

            $stmt = $db->query("SELECT * FROM educational WHERE emp_no='$user_id' AND educational_level='graduate' ");            
            while($data = $stmt->fetch(PDO::FETCH_OBJ)){
            
                $this->SetFont('Arial','',7);
                $this->SetTextColor(0,0,0);
                $this->Cell(45,6,"GRADUATE STUDIES",1,0,'C',true);
                $this->SetTextColor(0,0,255);
                $this->SetFont('Arial','',5);
                //$this->Cell(45,6,strtoupper($data->e_nameofschool),1,0,'C');

                $course_name = strlen($data->e_nameofschool);
                if($course_name > 76 ){
                    $this->SetFont('Arial','',4);
                }
                if($course_name > 98 ){
                    $this->SetFont('Helvetica','',2.5);
                }
                //$this->Cell(45,6,strtoupper($data->e_nameofschool),1,0,'C');
                if($course_name < 40 ){
                    //$this->SetFont('Arial','',5);
                    $this->Cell(45,6,strtoupper($data->e_nameofschool),1,0,'C');
                }else{
                    //$this->SetFont('Arial','',5);
                    $this->MultiCell(45,3,strtoupper($data->e_nameofschool),1,'C');
                    $x = $this->GetX();
                    $y = $this->GetY();
                    $this->SetXY($x + 90, $y-6);
                }
                
                $this->SetFont('Arial','',5);
                $course_len = strlen($data->e_course);
                //echo $course_len;
                if($course_len > 76 ){
                    $this->SetFont('Arial','',3);
                }
                if($course_len < 35 ){
                    //$this->SetFont('Arial','',5);
                    $this->Cell(40,6,strtoupper($data->e_course),1,0,'C');
                }else{                    
                    $this->MultiCell(40,3,strtoupper($data->e_course),1,'C');
                    $x = $this->GetX();
                    $y = $this->GetY();
                    $this->SetXY($x + 130, $y-6);
                }

                $this->SetFont('Arial','',5);
                $this->Cell(10,6,strtoupper($data->e_from),1,0,'C');
                $this->Cell(10,6,strtoupper($data->e_to),1,0,'C');


                //HIGHEST LEVEL / UNITS EARNED
                if(strlen($data->e_level) > 29 ){
                    $this->SetFont('Arial','',3);
                }
                if(strlen($data->e_level) < 10 ){ 
                    $this->Cell(15,6,strtoupper($data->e_level),1,0,'C');
                }else{
                    //$this->SetFont('Arial','',4); 
                    $this->MultiCell(15,3,strtoupper($data->e_level),1,'C');   
                    $x = $this->GetX();
                    $y = $this->GetY();
                    $this->SetXY($x + 165, $y-6);                 
                }

                $this->SetFont('Arial','',5);
                $this->Cell(15,6,strtoupper($data->e_year),1,0,'C');
                //$x = $this->GetX();
                //$y = $this->GetY();                
                //$this->SetXY($x,$y-5);
                if(strlen($data->e_scholarship) > 16 ){
                    $this->SetFont('Arial','',4);
                }
                if(strlen($data->e_scholarship) < 10 ){ 
                    $this->Cell(15,6,strtoupper($data->e_scholarship),1,1,'C');
                }else{
                    //$this->SetFont('Arial','',4);   
                    $this->MultiCell(15,3,strtoupper($data->e_scholarship),1,'C');
                }
            }

        }                 
       
    }

    function civilservice($db){ 

        if(isset($_GET['emp_no'])){
            $user_id = $_GET['emp_no']; 

            $this->SetFont('Arial','I',10);
            $this->SetFillColor(115,115,115);
            $this->SetTextColor(255,255,255);
            $this->Cell(195,5,'IV.  CIVIL SERVICE ELIGIBILITY',1,1,'L',true);

            $this->SetFont('Arial','',5);
            $this->SetTextColor(0,0,0);
            $this->SetFillColor(194,194,194);
            $this->Cell(60,1,"",'TL',0,'L',true);
            $this->SetFont('Arial','',4);
            $this->Cell(20,1,"",'TL',0,'L',true);
            $this->Cell(20,1,"",'TL',0,'L',true);
            $this->Cell(60,1,"",'TL',0,'L',true);
            $this->Cell(35,1,"",'TLR',1,'L',true);                        
            
            $this->SetFont('Arial','',5);
            $this->SetTextColor(0,0,0);
            $this->SetFillColor(194,194,194);
            $this->Cell(60,3,"27.                 CAREER SERVICE/ RA 1080 (BOARD/ BAR)",'L',0,'L',true);
            $this->SetFont('Arial','',6);
            $this->Cell(20,3,"RATING",'LR',0,'C',true);
            $this->Cell(20,3,"DATE OF",'LR',0,'C',true);            
            $this->Cell(60,3,"",'LR',0,'C',true);            
            $this->Cell(35,3,"LICENSE (if applicable)",'LR',1,'C',true);

            $this->SetFont('Arial','',5);
            $this->Cell(60,3,"UNDER SPECIAL LAWS/ CES/ CSEE",'L',0,'C',true);           
            $this->Cell(20,3,"(If Applicable)",'LR',0,'C',true);
            $this->SetFont('Arial','',6);
            $this->Cell(20,3,"EXAMINATION/",'LR',0,'C',true);
            $this->Cell(60,3,"PLACE OF EXAMINATION / CONFERMENT",'LR',0,'C',true);
            $this->SetFont('Arial','',7);
            $this->Cell(20,3,"NUMBER",'LTR',0,'C',true);
            $this->SetFont('Arial','',5);
            $this->Cell(15,3,"Date of",'LTR',1,'C',true);            

            $this->SetFont('Arial','',5);
            $this->Cell(60,3,"BARANGAY ELIGIBILITY / DRIVER'S LICENSE",'BL',0,'C',true);            
            $this->Cell(20,3,"",'BL',0,'L',true);
            $this->SetFont('Arial','',6);
            $this->Cell(20,3,"CONFERMENT",'BL',0,'C',true);
            $this->Cell(60,3,"",'BL',0,'C',true);            
            $this->Cell(20,3,"",'BL',0,'L',true);
            $this->SetFont('Arial','',5);
            $this->Cell(15,3,"Validity",'BLR',1,'C',true);
            
            $career_service = array();
            $rating = array();
            $date_of_exam = array();
            $place_of_exam = array();
            $license_no = array();
            $date_of_validity = array();

            $stmt = $db->query("SELECT * FROM civil_service WHERE emp_no='$user_id' ");            
            while($data = $stmt->fetch(PDO::FETCH_OBJ)){
                $cs = $data->career_service;
                $r = $data->rating;
                $de = $data->date_of_exam;
                $pe = $data->place_of_exam;
                $lno = $data->license_no;
                $dv = $data->date_of_validity;

                array_push($career_service,$cs);
                array_push($rating,$r);
                array_push($date_of_exam,$de);
                array_push($place_of_exam,$pe);
                array_push($license_no,$lno);
                array_push($date_of_validity,$dv);
            }
            $count = count($career_service);
            //echo $count;
            for($x = $count; $x < 10; $x++){
                $career_service[$x]="";
                $rating[$x]="";
                $date_of_exam[$x]=null;
                $place_of_exam[$x]="";
                $license_no[$x]="";
                $date_of_validity[$x]=null;
            }

            
            for($y = 0; $y < 10; $y++){
                $this->SetFont('Arial','',5);
                $this->SetTextColor(0,0,255);

                $career_len = strlen($career_service[$y]);
                if($career_len > 112 ){
                    $this->SetFont('Arial','',4);                    
                }
                if($career_len < 56 ){
                    $this->Cell(60,8,strtoupper($career_service[$y]),'BL',0,'C');                    
                }else{
                    //$this->SetFont('Arial','',6);
                    $this->MultiCell(60,4,strtoupper($career_service[$y]),'BL','C');                    
                    $a = $this->GetX();
                    $b = $this->GetY();
                    $this->SetXY($a + 60, $b-8);
                }
                $this->SetFont('Arial','',5);
                //$this->Cell(60,8,strtoupper($career_service[$y]),'BL',0,'C');
                $this->Cell(20,8,strtoupper($rating[$y]),'BL',0,'C');

                if($count<=$y){
                    $this->Cell(20,8,"",'BL',0,'C');
                }else{ 

                    if($date_of_exam[$y]=="N/A"){
                        $this->Cell(20,8,$date_of_exam[$y],'BL',0,'C');
                    }else{
                        $date=date_create($date_of_exam[$y]); 
                        if(strlen($date_of_exam[$y]) > 10 ){
                            $this->Cell(20,8,$date_of_exam[$y],'BL',0,'C');
                        }else{               
                            $this->Cell(20,8,date_format($date,"m/d/Y"),'BL',0,'C');
                        }    
                    }

                }

                $place_len = strlen($place_of_exam[$y]);
                if($place_len > 112 ){
                    $this->SetFont('Arial','',4);                    
                }
                if($place_len < 56 ){
                    $this->Cell(60,8,strtoupper($place_of_exam[$y]),'BL',0,'C');                     
                }else{
                    //$this->SetFont('Arial','',6);
                    //$this->MultiCell(60,8,strtoupper($place_of_exam[$y]),'BL',0,'C'); 
                    $this->MultiCell(60,4,strtoupper($place_of_exam[$y]),'BL','C');                    
                    $a = $this->GetX();
                    $b = $this->GetY();
                    $this->SetXY($a + 160, $b-8);
                }
                $this->SetFont('Arial','',5);
                //$this->Cell(60,8,strtoupper($place_of_exam[$y]),'BL',0,'C');                
                $this->Cell(20,8,strtoupper($license_no[$y]),'BL',0,'C');

                if($count<=$y){
                    $this->Cell(15,8,"",'BLR',1,'C');
                }else{                     
                              
                    
                    if($date_of_validity[$y]=="N/A"){
                        $this->Cell(15,8,$date_of_validity[$y],'BLR',1,'C');
                    }else{
                        $date=date_create($date_of_validity[$y]);                
                        $this->Cell(15,8,date_format($date,"m/d/Y"),'BLR',1,'C');
                    }

                } 
                
            }

        }                 
       
    }

    function workexperience($db){

        if(isset($_GET['emp_no'])){
            $user_id = $_GET['emp_no']; 

            $this->SetFont('Arial','I',10);
            $this->SetFillColor(115,115,115);
            $this->SetTextColor(255,255,255);
            $this->Cell(195,5,'V.  WORK EXPERIENCE','LTR',1,'L',true);
            $this->SetFont('Arial','I',7);
            $this->Cell(195,3,'(Include private employment.  Start from your recent work) Description of duties should be indicated in the attached Work Experience sheet.','LBR',1,'L',true);

            $this->SetFont('Arial','',4);
            $this->SetTextColor(0,0,0);
            $this->SetFillColor(194,194,194);
            $this->Cell(30,2,"",'TL',0,'L',true);            
            $this->Cell(50,2,"",'TL',0,'L',true);
            $this->Cell(60,2,"",'TL',0,'L',true);
            $this->Cell(15,2,"",'TL',0,'L',true);
            $this->Cell(15,2,"",'TL',0,'L',true);
            $this->Cell(15,2,"",'TL',0,'L',true);
            $this->Cell(10,2,"",'TLR',1,'L',true);                        
            
            $this->SetFont('Arial','',6);
            $this->SetTextColor(0,0,0);
            $this->SetFillColor(194,194,194);
            $this->Cell(30,2,"28.    INCLUSIVE DATES",'L',0,'L',true);            
            $this->Cell(50,2,"",'LR',0,'C',true);
            $this->Cell(60,2,"",'LR',0,'C',true);            
            $this->Cell(15,2,"",'LR',0,'C',true); 
            $this->SetFont('Arial','',4);           
            $this->Cell(15,2,"SALARY/ JOB/ PAY",'LR',0,'C',true);            
            $this->Cell(15,2,"",'LR',0,'C',true);            
            $this->Cell(10,2,"",'LR',1,'C',true);

            $this->SetFont('Arial','',6);
            $this->SetTextColor(0,0,0);
            $this->SetFillColor(194,194,194);
            $this->Cell(30,2,"(mm/dd/yyyy)",'L',0,'C',true);            
            $this->Cell(50,2,"POSITION TITLE",'LR',0,'C',true);
            $this->Cell(60,2,"DEPARTMENT / AGENCY / OFFICE / COMPANY",'LR',0,'C',true);            
            $this->Cell(15,2,"MONTHLY",'LR',0,'C',true); 
            $this->SetFont('Arial','',4);           
            $this->Cell(15,2,"GRADE (if",'LR',0,'C',true);   
            $this->SetFont('Arial','',5);         
            $this->Cell(15,2,"STATUS OF",'LR',0,'C',true);            
            $this->Cell(10,2,"GOV'T",'LR',1,'C',true);

            $this->SetFont('Arial','',6);
            $this->SetTextColor(0,0,0);
            $this->SetFillColor(194,194,194);
            $this->Cell(30,2,"",'LB',0,'C',true);  
            $this->SetFont('Arial','',5);          
            $this->Cell(50,2,"(Write in full/Do not abbreviate)",'LR',0,'C',true);
            $this->Cell(60,2,"(Write in full/Do not abbreviate)",'LR',0,'C',true);   
            $this->SetFont('Arial','',6);         
            $this->Cell(15,2,"SALARY",'LR',0,'C',true); 
            $this->SetFont('Arial','',4);           
            $this->Cell(15,2,"applicable)& STEP",'LR',0,'C',true);   
            $this->SetFont('Arial','',5);         
            $this->Cell(15,2,"APPOINTMENT",'LR',0,'C',true);            
            $this->Cell(10,2,"SERVICE",'LR',1,'C',true);

            $this->SetFont('Arial','',6);
            $this->SetTextColor(0,0,0);
            $this->SetFillColor(194,194,194);
            $this->Cell(15,2,"",'LT',0,'C',true);  
            $this->Cell(15,2,"",'LT',0,'C',true);              
            $this->Cell(50,2,"",'LR',0,'C',true);
            $this->Cell(60,2,"",'LR',0,'C',true);                       
            $this->Cell(15,2,"",'LR',0,'C',true); 
            $this->SetFont('Arial','',4);           
            $this->Cell(15,2,'(Format "00-0")/','LR',0,'C',true);   
            $this->SetFont('Arial','',5);         
            $this->Cell(15,2,"",'LR',0,'C',true);            
            $this->Cell(10,2,"(Y/ N)",'LR',1,'C',true);

            $this->SetFont('Arial','',6);
            $this->SetTextColor(0,0,0);
            $this->SetFillColor(194,194,194);
            $this->Cell(15,2,"From",'L',0,'C',true);  
            $this->Cell(15,2,"To",'L',0,'C',true);
            $this->Cell(50,2,"",'LR',0,'C',true);
            $this->Cell(60,2,"",'LR',0,'C',true);                       
            $this->Cell(15,2,"",'LR',0,'C',true); 
            $this->SetFont('Arial','',4);           
            $this->Cell(15,2,"INCREMENT",'LR',0,'C',true);
            $this->Cell(15,2,"",'LR',0,'C',true);            
            $this->Cell(10,2,"",'LR',1,'C',true);

            $this->SetFont('Arial','',4);
            $this->SetTextColor(0,0,0);
            $this->SetFillColor(194,194,194);
            $this->Cell(15,1,"",'BL',0,'L',true);            
            $this->Cell(15,1,"",'BL',0,'L',true);            
            $this->Cell(50,1,"",'BL',0,'L',true);
            $this->Cell(60,1,"",'BL',0,'L',true);
            $this->Cell(15,1,"",'BL',0,'L',true);
            $this->Cell(15,1,"",'BL',0,'L',true);
            $this->Cell(15,1,"",'BL',0,'L',true);
            $this->Cell(10,1,"",'BLR',1,'L',true);

            $w_from = array();
            $w_to = array();
            $position_title = array();
            $department = array();
            $salary = array();
            $step = array();
            $appointment = array();
            $govt_service = array();

            $stmt = $db->query("SELECT * FROM work_experience WHERE emp_no='$user_id' ORDER BY w_from DESC");            
            while($data = $stmt->fetch(PDO::FETCH_OBJ)){
                $wf = $data->w_from;
                $wt = $data->w_to;
                $pt = $data->position_title;
                $dept = $data->department;
                $sal = $data->salary;
                $stp = $data->step;
                $app = $data->appointment;
                $gov = $data->govt_service;

                array_push($w_from,$wf);
                array_push($w_to,$wt);
                array_push($position_title,$pt);
                array_push($department,$dept);
                array_push($salary,$sal);
                array_push($step,$stp);
                array_push($appointment,$app);
                array_push($govt_service,$gov);
            }
            $count = count($department);
            //echo $count;
            for($x = $count; $x < 20; $x++){
                $w_from[$x]=null;
                $w_to[$x]=null;
                $position_title[$x]="";
                $department[$x]="";
                $salary[$x]="";
                $step[$x]="";
                $appointment[$x]="";
                $govt_service[$x]="";
            }

            for($y = 0; $y < 20; $y++){
                $this->SetFont('Arial','',6);
                $this->SetTextColor(0,0,255);               

                if($count<=$y){
                    $this->Cell(15,8,"",'BL',0,'L');
                }else{                     
                    
                    if($w_from[$y]=="N/A"){
                        $this->Cell(15,8,$w_from[$y],'BL',0,'C');
                    }else{
                        $date=date_create($w_from[$y]);                
                        $this->Cell(15,8,date_format($date,"m/d/Y"),'BL',0,'C');
                    }


                }

                if($count<=$y){
                    $this->Cell(15,8,"",'BL',0,'L');
                }else{
                    if($w_to[$y] == "PRESENT"){
                        $this->Cell(15,8,strtoupper($w_to[$y]),'BL',0,'C');
                    }else{

                        if($w_to[$y]=="N/A"){
                            $this->Cell(15,8,$w_to[$y],'BL',0,'C');
                        }else{
                            $date=date_create($w_to[$y]);                
                            $this->Cell(15,8,date_format($date,"m/d/Y"),'BL',0,'C');
                        }

                    }   
                }   
                         
                $this->Cell(50,8,strtoupper($position_title[$y]),'BL',0,'C');

                $dept_len = strlen($department[$y]);
                //echo $course_len;
                if($dept_len < 45 ){
                    $this->Cell(60,8,strtoupper($department[$y]),'BL',0,'C');                    
                }else{
                    $this->SetFont('Arial','',6);
                    $this->MultiCell(60,4,strtoupper($department[$y]),'BL','C');
                    $a = $this->GetX();
                    $b = $this->GetY();
                    $this->SetXY($a + 140, $b-8);
                }
                

                if($salary[$y]==""){
                    $this->Cell(15,8,"",'BL',0,'C');
                }else{
                    
                    if($salary[$y]=="N/A"){
                        $this->Cell(15,8,$salary[$y],'BL',0,'C');
                    }else{
                        $this->Cell(15,8,"P".number_format($salary[$y]),'BL',0,'C');
                    }
                    
                }
                $this->Cell(15,8,strtoupper($step[$y]),'BL',0,'C');


                

                if(strlen($appointment[$y]) < 12 ){
                    $this->Cell(15,8,strtoupper($appointment[$y]),'BL',0,'C');
                }else{
                    $this->SetFont('Arial','',4);
                    $this->MultiCell(15,4,strtoupper($appointment[$y]),1,'C');
                    $a = $this->GetX();
                    $b = $this->GetY();
                    $this->SetXY($a + 185, $b-8);
                }

                $this->SetFont('Arial','',6);
                //$this->Cell(10,8,substr(strtoupper($govt_service[$y]),0,1),'BLR',1,'C');
                if($govt_service[$y]=="N/A"){
                    $this->Cell(10,8,$govt_service[$y],'BLR',1,'C');
                }else{
                    $this->Cell(10,8,substr(strtoupper($govt_service[$y]),0,1),'BLR',1,'C');
                }

            }
            
                
            

        }                 
       
    }

    function voluntary($db){

        if(isset($_GET['emp_no'])){
            $user_id = $_GET['emp_no']; 

            $this->SetFont('Arial','I',9);
            $this->SetFillColor(115,115,115);
            $this->SetTextColor(255,255,255);
            $this->Cell(195,5,'VI. VOLUNTARY WORK OR INVOLVEMENT IN CIVIC / NON-GOVERNMENT / PEOPLE / VOLUNTARY ORGANIZATION/S',1,1,'L',true);

            $this->SetFont('Arial','',5);
            $this->SetTextColor(0,0,0);
            $this->SetFillColor(194,194,194);
            $this->Cell(80,1,"",'TL',0,'L',true);            
            $this->Cell(30,1,"",'TL',0,'L',true);
            $this->Cell(15,1,"",'TL',0,'L',true);
            $this->Cell(70,1,"",'TLR',1,'L',true);                       
                                    
            $this->Cell(80,3,"29.                                            NAME & ADDRESS OF ORGANIZATION",'L',0,'L',true);
            $this->Cell(30,3,"INCLUSIVE DATES",'LR',0,'C',true); 
            $this->Cell(15,3,"NUMBER OF",'L',0,'C',true); 
            $this->Cell(70,3,"",'LR',1,'C',true);            
            
            $this->SetFont('Arial','',5);
            $this->Cell(80,2," (Write in full)",'L',0,'C',true);           
            $this->Cell(30,2,"(mm/dd/yyyy)",'LBR',0,'C',true);          
            $this->Cell(15,2,"HOURS",'LR',0,'C',true);
            $this->Cell(70,2,"POSITION / NATURE OF WORK",'LR',1,'C',true);
                        
            $this->Cell(80,3,"",'BL',0,'C',true);            
            $this->Cell(15,3,"From",'BTL',0,'C',true);
            $this->Cell(15,3,"To",'BTL',0,'C',true);
            $this->Cell(15,3,"",'BL',0,'C',true);            
            $this->Cell(70,3,"",'BLR',1,'L',true);

            $org_name = array();
            $org_address = array();
            $o_from = array();
            $o_to = array();
            $org_hours = array();
            $nature_work = array();

            $stmt = $db->query("SELECT * FROM voluntary_work WHERE emp_no='$user_id' ");            
            while($data = $stmt->fetch(PDO::FETCH_OBJ)){
                $oname = $data->org_name;
                $oadd = $data->org_address;
                $ofrom = $data->o_from;
                $oto = $data->o_to;
                $ohour = $data->org_hours;
                $nw = $data->nature_work;

                array_push($org_name,$oname);
                array_push($org_address,$oadd);
                array_push($o_from,$ofrom);
                array_push($o_to,$oto);
                array_push($org_hours,$ohour);
                array_push($nature_work,$nw);
            }
            $count = count($org_name);
            //echo $count;
            for($x = $count; $x < 7; $x++){
                $org_name[$x]="";
                $org_address[$x]="";
                $o_from[$x]="";
                $o_to[$x]="";
                $org_hours[$x]="";
                $nature_work[$x]="";
            }
            //$date=date_create($w_from[$y]);                
            //$this->Cell(15,8,date_format($date,"m/d/Y"),'BL',0,'C');

            for($y = 0; $y < 7; $y++){
                $this->SetFont('Arial','',5);
                $this->SetTextColor(0,0,255);
                
                if($org_name[$y]=="N/A"){
                    $this->Cell(80,6,strtoupper($org_name[$y]),'BL',0,'C');
                }else if($org_name[$y]!=""){
                    $orgnameadd = strlen($org_name[$y]." / ".$org_address[$y]);
                    
                    if($orgnameadd > 90 ){
                        $this->SetFont('Arial','',4);                    
                    }
                    if($orgnameadd < 75 ){
                        $this->Cell(80,6,strtoupper($org_name[$y])." / ".strtoupper($org_address[$y]),'BL',0,'C');                    
                    }else{
                        //$this->SetFont('Arial','',6);
                        $this->MultiCell(80,3,strtoupper($org_name[$y])." / ".strtoupper($org_address[$y]),'BL','C');
                        $a = $this->GetX();
                        $b = $this->GetY();
                        $this->SetXY($a + 80, $b-6);
                    }
                }
                else{
                    //$this->Cell(80,6,strtoupper($org_name[$y]),'BL',0,'C');

                    $orgname = strlen($org_name[$y]);
                    
                    //echo $course_len;
                    if($orgname > 90 ){
                        $this->SetFont('Arial','',4);                    
                    }
                    if($orgname < 60 ){
                        $this->Cell(80,6,strtoupper($org_name[$y]),'BL',0,'C');                    
                    }else{
                        //$this->SetFont('Arial','',6);
                        $this->MultiCell(80,3,strtoupper($org_name[$y]),'BL','C');
                        $a = $this->GetX();
                        $b = $this->GetY();
                        $this->SetXY($a + 80, $b-6);
                    }

                }
                $this->SetFont('Arial','',6);
                if($o_from[$y]!=""){
                    
                    if($o_from[$y]=="N/A"){
                        $this->Cell(15,6,$o_from[$y],'BTL',0,'C');
                    }else{
                        $date=date_create($o_from[$y]);   
                        $this->Cell(15,6,date_format($date,"m/d/Y"),'BTL',0,'C');
                    }


                }else{
                    $this->Cell(15,6,$o_from[$y],'BTL',0,'C');
                }

                
                if($o_to[$y]!=""){                    

                    if($o_to[$y]=="N/A"){
                        $this->Cell(15,6,$o_to[$y],'BTL',0,'C');
                    }else{
                        $date=date_create($o_to[$y]);   
                        $this->Cell(15,6,date_format($date,"m/d/Y"),'BTL',0,'C');
                    }

                }else{
                    $this->Cell(15,6,$o_to[$y],'BTL',0,'C');
                } 

                
                //$this->Cell(15,6,$o_to[$y],'BTL',0,'C');
                $this->Cell(15,6,strtoupper($org_hours[$y]),'BL',0,'C');            
                //$this->Cell(70,6,strtoupper($nature_work[$y]),'BLR',1,'C');
                $this->SetFont('Arial','',5);
                $nature_len = strlen($nature_work[$y]);
                    
                    if($nature_len > 90 ){
                        $this->SetFont('Arial','',4);                    
                    }
                    if($nature_len < 60 ){
                        $this->Cell(70,6,strtoupper($nature_work[$y]),'BLR',1,'C');                    
                    }else{
                        //$this->SetFont('Arial','',6) ;
                        $this->MultiCell(70,3,strtoupper($nature_work[$y]),'BL','C');
                        $a = $this->GetX();
                        $b = $this->GetY();
                        $this->SetXY($a + 120, $b-6);
                    }
            }

        }                 
       
    }

    function learning($db){

        if(isset($_GET['emp_no'])){
            $user_id = $_GET['emp_no']; 

            $this->SetFont('Arial','I',9);
            $this->SetFillColor(115,115,115);
            $this->SetTextColor(255,255,255);
            $this->Cell(195,5,'VII.  LEARNING AND DEVELOPMENT (L&D) INTERVENTIONS/TRAINING PROGRAMS ATTENDED','LTR',1,'L',true);
            $this->SetFont('Arial','I',6);
            $this->Cell(195,3,'(Start from the most recent L&D/training program and include only the relevant L&D/training taken for the last five (5) years for Division Chief/Executive/Managerial positions)','LBR',1,'L',true);

            $this->SetFont('Arial','',5);
            $this->SetTextColor(0,0,0);
            $this->SetFillColor(194,194,194);
            $this->Cell(80,1,"",'TL',0,'L',true);            
            $this->Cell(30,1,"",'TL',0,'L',true);
            $this->Cell(15,1,"",'TL',0,'L',true);
            $this->Cell(15,1,"",'TL',0,'L',true);
            $this->Cell(55,1,"",'TLR',1,'L',true);    
            
            $this->Cell(80,2,"",'L',0,'L',true);            
            $this->Cell(30,2,"INCLUSIVE DATES OF",'L',0,'C',true);
            $this->Cell(15,2,"",'L',0,'L',true);
            $this->SetFont('Arial','',4);
            $this->Cell(15,2,"Type of LD",'L',0,'C',true);
            $this->Cell(55,2,"",'LR',1,'L',true);       

            $this->SetFont('Arial','',5);
            $this->Cell(80,3,"30.       TITLE OF LEARNING AND DEVELOPMENT INTERVENTIONS/TRAINING PROGRAMS",'L',0,'L',true);
            $this->Cell(30,3,"ATTENDANCE",'LR',0,'C',true); 
            $this->Cell(15,3,"NUMBER OF",'L',0,'C',true); 
            $this->SetFont('Arial','',4);
            $this->Cell(15,3,"( Managerial/",'L',0,'C',true); 
            $this->SetFont('Arial','',5);
            $this->Cell(55,3," CONDUCTED/ SPONSORED BY",'LR',1,'C',true);            
            
            $this->SetFont('Arial','',5);
            $this->Cell(80,2," (Write in full)",'L',0,'C',true);           
            $this->Cell(30,2,"(mm/dd/yyyy)",'LBR',0,'C',true);          
            $this->Cell(15,2,"HOURS",'LR',0,'C',true);
            $this->SetFont('Arial','',4);
            $this->Cell(15,2,"Supervisory/",'L',0,'C',true);
            $this->Cell(55,2,"(Write in full)",'LR',1,'C',true);
            
            $this->SetFont('Arial','',5);
            $this->Cell(80,3,"",'BL',0,'C',true);            
            $this->Cell(15,3,"From",'BTL',0,'C',true);
            $this->Cell(15,3,"To",'BTL',0,'C',true);
            $this->Cell(15,3," ",'BL',0,'C',true);            
            $this->SetFont('Arial','',4);
            $this->Cell(15,3,"Technical/etc) ",'BL',0,'C',true);            
            $this->Cell(55,3,"",'LBR',1,'C',true);

            $title_of_ld = array();
            $ld_from = array();
            $ld_to = array();
            $o_to = array();
            $ld_hours = array();
            $type_of_ld = array();
            $conducted = array();

            $stmt = $db->query("SELECT * FROM learning_dev WHERE emp_no='$user_id' AND is_added='1' ORDER BY ld_from DESC");            
            while($data = $stmt->fetch(PDO::FETCH_OBJ)){
                $title = $data->title_of_ld;
                $ldfrom = $data->ld_from;
                $ldto = $data->ld_to;
                $ldhours = $data->ld_hours;
                $ldtype = $data->type_of_ld;
                $ldconduct = $data->conducted;

                array_push($title_of_ld,$title);
                array_push($ld_from,$ldfrom);
                array_push($ld_to,$ldto);
                array_push($ld_hours,$ldhours);
                array_push($type_of_ld,$ldtype);
                array_push($conducted,$ldconduct);
            }
            $count = count($title_of_ld);
            //echo $count;
            for($x = $count; $x < 20; $x++){
                $title_of_ld[$x]="";
                $ld_from[$x]=null;
                $ld_to[$x]=null;
                $ld_hours[$x]="";
                $type_of_ld[$x]="";
                $conducted[$x]="";
            }

            for($y = 0; $y < 20; $y++){                
                $this->SetFont('Arial','',6);
                $this->SetTextColor(0,0,255);

                $titleld = strlen($title_of_ld[$y]);
                //echo $course_len;
                if($titleld > 90 ){
                    $this->SetFont('Arial','',5);                    
                }
                if($titleld < 62 ){
                    $this->Cell(80,8,strtoupper($title_of_ld[$y]),'BL',0,'C');                    
                }else{
                    //$this->SetFont('Arial','',6);
                    $this->MultiCell(80,4,strtoupper($title_of_ld[$y]),'BL','C');
                    $a = $this->GetX();
                    $b = $this->GetY();
                    $this->SetXY($a + 80, $b-8);
                }
                
                $this->SetFont('Arial','',6);
                //$this->Cell(80,8,strtoupper($title_of_ld[$y]),'BL',0,'C');
                if($count<=$y){
                    $this->Cell(15,8,"",'BL',0,'L');
                }else{                     
                                        
                    if($ld_from[$y]=="N/A"){
                        $this->Cell(15,8,$ld_from[$y],'BTL',0,'C');
                    }else{
                        $date=date_create($ld_from[$y]);                
                        $this->Cell(15,8,date_format($date,"m/d/Y"),'BTL',0,'C');
                    }
                    
                }            
                if($count<=$y){
                    $this->Cell(15,8,"",'BL',0,'L');
                }else{                     
                    
                    if($ld_to[$y]=="N/A"){
                        $this->Cell(15,8,$ld_to[$y],'BTL',0,'C');
                    }else{
                        $date=date_create($ld_to[$y]);                
                        $this->Cell(15,8,date_format($date,"m/d/Y"),'BTL',0,'C');
                    }

                } 
                $this->Cell(15,8,strtoupper($ld_hours[$y]),'BL',0,'C');
                $this->Cell(15,8,strtoupper($type_of_ld[$y]),'BL',0,'C');  
                
                $conduct = strlen($conducted[$y]);
                //echo $course_len;
                $this->SetFont('Arial','',6);
                if($conduct > 88 ){
                    $this->SetFont('Arial','',4);                    
                }
                if($conduct > 118 ){
                    $this->SetFont('Arial','',3.5);                    
                }
                if($conduct > 150 ){
                    $this->SetFont('Arial','',2.5);                    
                }
                if($conduct < 44 ){
                    $this->Cell(55,8,strtoupper($conducted[$y]),'LBR',1,'C');                    
                }else{
                    //$this->SetFont('Arial','',6);
                    $this->MultiCell(55,4,strtoupper($conducted[$y]),'LBR','C');
                    //$a = $this->GetX();
                    // $b = $this->GetY();
                    //$this->SetXY($a + 205, $b-8);
                }
                //$this->Cell(55,8,strtoupper($conducted[$y]),'LBR',1,'C');
            }

        }                 
       
    }

    function otherinfo($db){

        if(isset($_GET['emp_no'])){
            $user_id = $_GET['emp_no']; 

            $this->SetFont('Arial','I',9);
            $this->SetFillColor(115,115,115);
            $this->SetTextColor(255,255,255);
            $this->Cell(195,5,'VIII.  OTHER INFORMATION',1,1,'L',true);

            $this->SetFont('Arial','',5);
            $this->SetTextColor(0,0,0);
            $this->SetFillColor(194,194,194);
            $this->Cell(60,1,"",'TL',0,'L',true);            
            $this->Cell(80,1,"",'TL',0,'L',true);            
            $this->Cell(55,1,"",'TLR',1,'L',true);  
            
            $this->Cell(5,3,"31.",'L',0,'L',true);            
            $this->Cell(55,3,"SPECIAL SKILLS and HOBBIES",0,0,'C',true);            
            $this->Cell(5,3,"32.",'L',0,'L',true);            
            $this->Cell(75,3,"NON-ACADEMIC DISTINCTIONS / RECOGNITION",0,0,'C',true);            
            $this->Cell(5,3,"33.",'L',0,'L',true);
            $this->Cell(50,3,"MEMBERSHIP IN ASSOCIATION/ORGANIZATION",'R',1,'C',true);
            
            $this->Cell(5,2,"",'L',0,'L',true);            
            $this->Cell(55,2,"",0,0,'C',true);            
            $this->Cell(5,2,"",'L',0,'L',true);            
            $this->Cell(75,2,"(Write in full)",0,0,'C',true);            
            $this->Cell(5,2,"",'L',0,'L',true);
            $this->Cell(50,2,"(Write in full)",'R',1,'C',true);

            $this->Cell(60,1,"",'BL',0,'L',true);            
            $this->Cell(80,1,"",'BL',0,'L',true);            
            $this->Cell(55,1,"",'BLR',1,'L',true);
            
            

            $special_skills = array();
            $non_academic = array();
            $mem_in_asso = array();

            $stmt = $db->query("SELECT * FROM special_skills WHERE emp_no='$user_id' ");            
            while($data = $stmt->fetch(PDO::FETCH_OBJ)){
                $skill = $data->special_skills;     
                array_push($special_skills,$skill);
            }
            $count = count($special_skills);
            //echo $count;
            for($x = $count; $x < 7; $x++){
                $special_skills[$x]="";
            }

            $stmt = $db->query("SELECT * FROM non_academic WHERE emp_no='$user_id' ");            
            while($data = $stmt->fetch(PDO::FETCH_OBJ)){
                $nonacad = $data->non_academic;     
                array_push($non_academic,$nonacad);
            }
            $count = count($non_academic);
            //echo $count;
            for($x = $count; $x < 7; $x++){
                $non_academic[$x]="";
            }

            $stmt = $db->query("SELECT * FROM association WHERE emp_no='$user_id' ");            
            while($data = $stmt->fetch(PDO::FETCH_OBJ)){
                $asso = $data->mem_in_asso;     
                array_push($mem_in_asso,$asso);
            }
            $count = count($mem_in_asso);
            //echo $count;
            for($x = $count; $x < 7; $x++){
                $mem_in_asso[$x]="";
            }

            for($y = 0; $y < 7; $y++){
                $this->SetFont('Arial','',5);
                $this->SetTextColor(0,0,255);

                $skilllen = strlen($special_skills[$y]);
                //echo $course_len;
                if($skilllen > 92 ){
                    $this->SetFont('Arial','',3);                    
                }
                if($skilllen < 47 ){
                    $this->Cell(60,6,strtoupper($special_skills[$y]),'BL',0,'C');                    
                }else{
                    //$this->SetFont('Arial','',6);
                    $this->MultiCell(60,3,strtoupper($special_skills[$y]),'BL','C');
                    $a = $this->GetX();
                    $b = $this->GetY();
                    $this->SetXY($a + 60, $b-6);
                }
                $this->SetFont('Arial','',5);
                //$this->Cell(60,6,strtoupper($special_skills[$y]),'BL',0,'C');  
                
                $nonacadlen = strlen($non_academic[$y]);
                //echo $course_len;
                if($nonacadlen > 110 ){
                    $this->SetFont('Arial','',4);                    
                }
                if($nonacadlen > 160 ){
                    $this->SetFont('Arial','',3);                    
                }
                if($nonacadlen < 56 ){
                    $this->Cell(80,6,strtoupper($non_academic[$y]),'BL',0,'C');                    
                }else{
                    //$this->SetFont('Arial','',6);
                    $this->MultiCell(80,3,strtoupper($non_academic[$y]),'BL','C');
                    $a = $this->GetX();
                    $b = $this->GetY();
                    $this->SetXY($a + 140, $b-6);
                }

                //$this->Cell(80,6,strtoupper($non_academic[$y]),'BL',0,'C'); 
                $this->SetFont('Arial','',5);
                $memlen = strlen($mem_in_asso[$y]);
                //echo $course_len;
                if($memlen > 82 ){
                    $this->SetFont('Arial','',3);                    
                }
                if($memlen < 42 ){
                    $this->Cell(55,6,strtoupper($mem_in_asso[$y]),'BLR',1,'C');                    
                }else{
                    //$this->SetFont('Arial','',6);
                    $this->MultiCell(55,3,strtoupper($mem_in_asso[$y]),'BLR','C');
                    $a = $this->GetX();
                    $b = $this->GetY();
                    //$this->SetXY($a + 195, $b-6);
                }

                //$this->Cell(55,6,strtoupper($mem_in_asso[$y]),'BLR',1,'C');
            }

        }                 
       
    }

    function fourthpage($db){

        if(isset($_GET['emp_no'])){
            $user_id = $_GET['emp_no'];                        
            $stmt = $db->query("SELECT * FROM other_info WHERE emp_no='$user_id'");            
            while($data = $stmt->fetch(PDO::FETCH_OBJ)){

                $this->SetFont('Arial','',7);
                $this->SetTextColor(0,0,0);
                $this->SetFillColor(194,194,194);
                $this->Cell(5,4,"34.",'LT',0,'L',true);            
                $this->Cell(120,4,"Are you related by consanguinity or affinity to the appointing or recommending authority, or to the",'T',0,'L',true);            
                $this->Cell(70,4,"",'TLR',1,'L');            

                $this->Cell(5,4,"",'L',0,'L',true);            
                $this->Cell(120,4,"chief of bureau or office or to the person who has immediate supervision over you in the Office, ",0,0,'L',true);            
                $this->Cell(70,4,"",'LR',1,'L');            
                
                $this->Cell(5,4,"",'L',0,'L',true);            
                $this->Cell(120,4,"Bureau or Department where you will be apppointed,",0,0,'L',true);            
                $this->Cell(70,4,"",'LR',1,'L');            

                $this->Cell(5,4,"",'L',0,'L',true);            
                $this->Cell(120,4,"a. within the third degree?",'R',0,'L',true);            
                //$this->Cell(70,4,"",'LR',1,'L');            

                    if($data->q34_a == "yes")
                    $check = "3"; else $check = "";
                    $this->SetFont('ZapfDingbats','', 12);
                    $this->SetTextColor(0,0,255);
                    //$this->Cell(5);
                    $this->Cell(1,4," ".$check, 0, 0);
                    $this->SetTextColor(0,0,0);
                    $this->SetFont('ZapfDingbats','', 10);
                    $this->Cell(4,4, "r",0, 0);
                    $this->SetFont('Arial','',7);
                    $this->SetTextColor(0,0,0);                
                    $this->Cell(10,4,"Yes",0, 0);

                    if($data->q34_a == "no")
                    $check = "3"; else $check = "";
                    $this->SetFont('ZapfDingbats','', 12);
                    $this->SetTextColor(0,0,255);
                    $this->Cell(1,4," ".$check, 0, 0);
                    $this->SetTextColor(0,0,0);
                    $this->SetFont('ZapfDingbats','', 10);
                    $this->Cell(4,4, "r",0, 0);
                    $this->SetFont('Arial','',7);
                    $this->SetTextColor(0,0,0);                
                    $this->Cell(50,4,"No","R", 1,'L');

                $this->Cell(5,4,"",'L',0,'L',true);            
                $this->Cell(120,4,"b. within the fourth degree (for Local Government Unit - Career Employees)?",'R',0,'L',true);            
                //$this->Cell(70,4,"",'LR',1,'L');  
                
                    if($data->q34_b == "yes")
                    $check = "3"; else $check = "";
                    $this->SetFont('ZapfDingbats','', 12);
                    $this->SetTextColor(0,0,255);
                    //$this->Cell(5);
                    $this->Cell(1,4," ".$check, 0, 0);
                    $this->SetTextColor(0,0,0);
                    $this->SetFont('ZapfDingbats','', 10);
                    $this->Cell(4,4, "r",0, 0);
                    $this->SetFont('Arial','',7);
                    $this->SetTextColor(0,0,0);                
                    $this->Cell(10,4,"Yes",0, 0);

                    if($data->q34_b == "no")
                    $check = "3"; else $check = "";
                    $this->SetFont('ZapfDingbats','', 12);
                    $this->SetTextColor(0,0,255);
                    $this->Cell(1,4," ".$check, 0, 0);
                    $this->SetTextColor(0,0,0);
                    $this->SetFont('ZapfDingbats','', 10);
                    $this->Cell(4,4, "r",0, 0);
                    $this->SetFont('Arial','',7);
                    $this->SetTextColor(0,0,0);                
                    $this->Cell(50,4,"No","R", 1,'L');

                $this->Cell(5,4,"",'L',0,'L',true);            
                $this->Cell(120,4,"",'R',0,'L',true);
                $this->Cell(70,4,"  If YES, give details:",'LR',1,'L');

                $this->Cell(5,3,"",'L',0,'L',true);            
                $this->Cell(120,3,"",'R',0,'L',true);
                $this->Cell(3,3,"",'L',0,'L');
                $this->SetTextColor(0,0,255);
                $this->Cell(64,3,strtoupper($data->q34_b_details),'B',0,'L');
                $this->Cell(3,3,"",'R',1,'L');

                $this->Cell(5,1,"",'LB',0,'L',true);            
                $this->Cell(120,1,"",'RB',0,'L',true);
                $this->Cell(70,1,"",'LBR',1,'L');
                
                $this->SetTextColor(0,0,0);
                $this->Cell(5,4,"35.",'LT',0,'L',true);                            
                $this->Cell(120,4,"a. Have you ever been found guilty of any administrative offense?",'TR',0,'L',true);                        

                    if($data->q35_a == "yes")
                    $check = "3"; else $check = "";
                    $this->SetFont('ZapfDingbats','', 12);
                    $this->SetTextColor(0,0,255);
                    //$this->Cell(5);
                    $this->Cell(1,4," ".$check, 0, 0);
                    $this->SetTextColor(0,0,0);
                    $this->SetFont('ZapfDingbats','', 10);
                    $this->Cell(4,4, "r",0, 0);
                    $this->SetFont('Arial','',7);
                    $this->SetTextColor(0,0,0);                
                    $this->Cell(10,4,"Yes",0, 0);

                    if($data->q35_a == "no")
                    $check = "3"; else $check = "";
                    $this->SetFont('ZapfDingbats','', 12);
                    $this->SetTextColor(0,0,255);
                    $this->Cell(1,4," ".$check, 0, 0);
                    $this->SetTextColor(0,0,0);
                    $this->SetFont('ZapfDingbats','', 10);
                    $this->Cell(4,4, "r",0, 0);
                    $this->SetFont('Arial','',7);
                    $this->SetTextColor(0,0,0);                
                    $this->Cell(50,4,"No","R", 1,'L');

                $this->Cell(5,4,"",'L',0,'L',true);            
                $this->Cell(120,4,"",'R',0,'L',true);
                $this->Cell(70,4,"  If YES, give details:",'LR',1,'L');

                $this->Cell(5,3,"",'L',0,'L',true);            
                $this->Cell(120,3,"",'R',0,'L',true);
                $this->Cell(3,3,"",'L',0,'L');
                $this->SetTextColor(0,0,255);
                $this->Cell(64,3,strtoupper($data->q35_a_details),'B',0,'L');                
                $this->Cell(3,3,"",'R',1,'L');

                $this->Cell(5,1,"",'L',0,'L',true);            
                $this->Cell(120,1,"",'R',0,'L',true);
                $this->Cell(70,1,"",'LBR',1,'L');
            
                $this->SetTextColor(0,0,0); 
                $this->Cell(5,4,"",'L',0,'L',true);            
                $this->Cell(120,4,"b. Have you been criminally charged before any court?",'R',0,'L',true);                        

                    if($data->q35_b == "yes")
                    $check = "3"; else $check = "";
                    $this->SetFont('ZapfDingbats','', 12);
                    $this->SetTextColor(0,0,255);
                    //$this->Cell(5);
                    $this->Cell(1,4," ".$check, 0, 0);
                    $this->SetTextColor(0,0,0);
                    $this->SetFont('ZapfDingbats','', 10);
                    $this->Cell(4,4, "r",0, 0);
                    $this->SetFont('Arial','',7);
                    $this->SetTextColor(0,0,0);                
                    $this->Cell(10,4,"Yes",0, 0);

                    if($data->q35_b == "no")
                    $check = "3"; else $check = "";
                    $this->SetFont('ZapfDingbats','', 12);
                    $this->SetTextColor(0,0,255);
                    $this->Cell(1,4," ".$check, 0, 0);
                    $this->SetTextColor(0,0,0);
                    $this->SetFont('ZapfDingbats','', 10);
                    $this->Cell(4,4, "r",0, 0);
                    $this->SetFont('Arial','',7);
                    $this->SetTextColor(0,0,0);                
                    $this->Cell(50,4,"No","R", 1,'L');

                $this->Cell(5,4,"",'L',0,'L',true);            
                $this->Cell(120,4,"",'R',0,'L',true);
                $this->Cell(70,4,"  If YES, give details:",'LR',1,'L');

                $this->Cell(5,4,"",'L',0,'L',true);            
                $this->Cell(120,4,"",'R',0,'L',true);
                $this->Cell(20,4,"",0,0,'L');
                $this->Cell(15,4,"Date Filed:",0,0,'R');
                $this->SetTextColor(0,0,255);
                $this->Cell(33,4,strtoupper($data->q35_b_date_filed),'B',0,'L');
                $this->Cell(2,4,"",'R',1,'L');

                $this->Cell(5,4,"",'L',0,'L',true);            
                $this->Cell(120,4,"",'R',0,'L',true);
                $this->Cell(20,4,"",0,0,'L');
                $this->SetTextColor(0,0,0);
                $this->Cell(15,4,"Status of Case/s:",0,0,'R');
                $this->SetTextColor(0,0,255);
                $this->Cell(33,4,strtoupper($data->q35_b_status),'B',0,'L');
                $this->Cell(2,4,"",'R',1,'L');

                $this->Cell(5,1,"",'LB',0,'L',true);            
                $this->Cell(120,1,"",'RB',0,'L',true);
                $this->Cell(70,1,"",'LBR',1,'L');

                $this->SetTextColor(0,0,0);
                $this->Cell(5,4,"36.",'LT',0,'L',true);            
                $this->Cell(120,4,"Have you ever been convicted of any crime or violation of any law, decree, ordinance or regulation",'TR',0,'L',true);                        

                    if($data->q36 == "yes")
                    $check = "3"; else $check = "";
                    $this->SetFont('ZapfDingbats','', 12);
                    $this->SetTextColor(0,0,255);
                    //$this->Cell(5);
                    $this->Cell(1,4," ".$check, 0, 0);
                    $this->SetTextColor(0,0,0);
                    $this->SetFont('ZapfDingbats','', 10);
                    $this->Cell(4,4, "r",0, 0);
                    $this->SetFont('Arial','',7);
                    $this->SetTextColor(0,0,0);                
                    $this->Cell(10,4,"Yes",0, 0);

                    if($data->q36 == "no")
                    $check = "3"; else $check = "";
                    $this->SetFont('ZapfDingbats','', 12);
                    $this->SetTextColor(0,0,255);
                    $this->Cell(1,4," ".$check, 0, 0);
                    $this->SetTextColor(0,0,0);
                    $this->SetFont('ZapfDingbats','', 10);
                    $this->Cell(4,4, "r",0, 0);
                    $this->SetFont('Arial','',7);
                    $this->SetTextColor(0,0,0);                
                    $this->Cell(50,4,"No","R", 1,'L');

                $this->Cell(5,4,"",'L',0,'L',true);            
                $this->Cell(120,4,"by any court or tribunal?",'R',0,'L',true);
                $this->Cell(70,4,"  If YES, give details:",'LR',1,'L');

                $this->Cell(5,3,"",'L',0,'L',true);            
                $this->Cell(120,3,"",'R',0,'L',true);
                $this->Cell(3,3,"",'L',0,'L');
                $this->SetTextColor(0,0,255);
                $this->Cell(64,3,strtoupper($data->	q36_details),'B',0,'L');
                $this->Cell(3,3,"",'R',1,'L');

                $this->Cell(5,1,"",'LB',0,'L',true);            
                $this->Cell(120,1,"",'RB',0,'L',true);
                $this->Cell(70,1,"",'LBR',1,'L');

                $this->SetTextColor(0,0,0);
                $this->Cell(5,4,"37.",'LT',0,'L',true);            
                $this->Cell(120,4,"Have you ever been separated from the service in any of the following modes: resignation,",'TR',0,'L',true);                        

                    if($data->q37 == "yes")
                    $check = "3"; else $check = "";
                    $this->SetFont('ZapfDingbats','', 12);
                    $this->SetTextColor(0,0,255);
                    //$this->Cell(5);
                    $this->Cell(1,4," ".$check, 0, 0);
                    $this->SetTextColor(0,0,0);
                    $this->SetFont('ZapfDingbats','', 10);
                    $this->Cell(4,4, "r",0, 0);
                    $this->SetFont('Arial','',7);
                    $this->SetTextColor(0,0,0);                
                    $this->Cell(10,4,"Yes",0, 0);

                    if($data->q37 == "male")
                    $check = "3"; else $check = "";
                    $this->SetFont('ZapfDingbats','', 12);
                    $this->SetTextColor(0,0,255);
                    $this->Cell(1,4," ".$check, 0, 0);
                    $this->SetTextColor(0,0,0);
                    $this->SetFont('ZapfDingbats','', 10);
                    $this->Cell(4,4, "r",0, 0);
                    $this->SetFont('Arial','',7);
                    $this->SetTextColor(0,0,0);                
                    $this->Cell(50,4,"No","R", 1,'L');

                $this->Cell(5,4,"",'L',0,'L',true);            
                $this->Cell(120,4,"retirement, dropped from the rolls, dismissal, termination, end of term, finished contract or phased",'R',0,'L',true);
                $this->Cell(70,4,"  If YES, give details:",'LR',1,'L');

                $this->Cell(5,3,"",'L',0,'L',true);            
                $this->Cell(120,3,"out (abolition) in the public or private sector?",'R',0,'L',true);
                $this->Cell(3,3,"",'L',0,'L');
                $this->SetTextColor(0,0,255);
                $this->Cell(64,3,strtoupper($data->q37_details),'B',0,'L');
                $this->Cell(3,3,"",'R',1,'L');

                $this->Cell(5,1,"",'LB',0,'L',true);            
                $this->Cell(120,1,"",'RB',0,'L',true);
                $this->Cell(70,1,"",'LBR',1,'L');
                
                $this->SetTextColor(0,0,0);
                $this->Cell(5,4,"38.",'LT',0,'L',true);            
                $this->Cell(120,4,"a. Have you ever been a candidate in a national or local election held within the last year (except",'TR',0,'L',true);                        

                    if($data->q38_a == "yes")
                    $check = "3"; else $check = "";
                    $this->SetFont('ZapfDingbats','', 12);
                    $this->SetTextColor(0,0,255);
                    //$this->Cell(5);
                    $this->Cell(1,4," ".$check, 0, 0);
                    $this->SetTextColor(0,0,0);
                    $this->SetFont('ZapfDingbats','', 10);
                    $this->Cell(4,4, "r",0, 0);
                    $this->SetFont('Arial','',7);
                    $this->SetTextColor(0,0,0);                
                    $this->Cell(10,4,"Yes",0, 0);

                    if($data->	q38_a == "no")
                    $check = "3"; else $check = "";
                    $this->SetFont('ZapfDingbats','', 12);
                    $this->SetTextColor(0,0,255);
                    $this->Cell(1,4," ".$check, 0, 0);
                    $this->SetTextColor(0,0,0);
                    $this->SetFont('ZapfDingbats','', 10);
                    $this->Cell(4,4, "r",0, 0);
                    $this->SetFont('Arial','',7);
                    $this->SetTextColor(0,0,0);                
                    $this->Cell(50,4,"No","R", 1,'L');

                $this->Cell(5,4,"",'L',0,'L',true);            
                $this->Cell(120,4,"Barangay election)?",'R',0,'L',true);
                $this->Cell(25,4,"  If YES, give details:",'L',0,'L');
                $this->SetTextColor(0,0,255);                
                $this->Cell(42,4,strtoupper($data->q38_a_details),'B',0,'L');
                $this->Cell(3,4,"",'R',1,'L');

                $this->Cell(5,1,"",'L',0,'L',true);            
                $this->Cell(120,1,"",'R',0,'L',true);
                $this->Cell(70,1,"",'LBR',1,'L');
                
                $this->SetTextColor(0,0,0);
                $this->Cell(5,4,"",'L',0,'L',true);            
                $this->Cell(120,4,"b. Have you resigned from the government service during the three (3)-month period before the last",'R',0,'L',true);                        

                    if($data->q38_b == "yes")
                    $check = "3"; else $check = "";
                    $this->SetFont('ZapfDingbats','', 12);
                    $this->SetTextColor(0,0,255);
                    //$this->Cell(5);
                    $this->Cell(1,4," ".$check, 0, 0);
                    $this->SetTextColor(0,0,0);
                    $this->SetFont('ZapfDingbats','', 10);
                    $this->Cell(4,4, "r",0, 0);
                    $this->SetFont('Arial','',7);
                    $this->SetTextColor(0,0,0);                
                    $this->Cell(10,4,"Yes",0, 0);

                    if($data->q38_b == "no")
                    $check = "3"; else $check = "";
                    $this->SetFont('ZapfDingbats','', 12);
                    $this->SetTextColor(0,0,255);
                    $this->Cell(1,4," ".$check, 0, 0);
                    $this->SetTextColor(0,0,0);
                    $this->SetFont('ZapfDingbats','', 10);
                    $this->Cell(4,4, "r",0, 0);
                    $this->SetFont('Arial','',7);
                    $this->SetTextColor(0,0,0);                
                    $this->Cell(50,4,"No","R", 1,'L');

                $this->Cell(5,4,"",'L',0,'L',true);            
                $this->Cell(120,4,"election to promote/actively campaign for a national or local candidate?",'R',0,'L',true);
                $this->Cell(25,4,"  If YES, give details:",'L',0,'L');
                $this->SetTextColor(0,0,255);
                $this->Cell(42,4,strtoupper($data->q38_b_details),'B',0,'L');
                $this->Cell(3,4,"",'R',1,'L');

                $this->Cell(5,1,"",'LB',0,'L',true);            
                $this->Cell(120,1,"",'RB',0,'L',true);
                $this->Cell(70,1,"",'LBR',1,'L');

                $this->SetTextColor(0,0,0);
                $this->Cell(5,4,"39.",'LT',0,'L',true);            
                $this->Cell(120,4,"Have you acquired the status of an immigrant or permanent resident of another country?",'TR',0,'L',true);                        

                    if($data->q39 == "yes")
                    $check = "3"; else $check = "";
                    $this->SetFont('ZapfDingbats','', 12);
                    $this->SetTextColor(0,0,255);
                    //$this->Cell(5);
                    $this->Cell(1,4," ".$check, 0, 0);
                    $this->SetTextColor(0,0,0);
                    $this->SetFont('ZapfDingbats','', 10);
                    $this->Cell(4,4, "r",0, 0);
                    $this->SetFont('Arial','',7);
                    $this->SetTextColor(0,0,0);                
                    $this->Cell(10,4,"Yes",0, 0);

                    if($data->q39 == "no")
                    $check = "3"; else $check = "";
                    $this->SetFont('ZapfDingbats','', 12);
                    $this->SetTextColor(0,0,255);
                    $this->Cell(1,4," ".$check, 0, 0);
                    $this->SetTextColor(0,0,0);
                    $this->SetFont('ZapfDingbats','', 10);
                    $this->Cell(4,4, "r",0, 0);
                    $this->SetFont('Arial','',7);
                    $this->SetTextColor(0,0,0);                
                    $this->Cell(50,4,"No","R", 1,'L');

                $this->Cell(5,4,"",'L',0,'L',true);            
                $this->Cell(120,4,"",'R',0,'L',true);
                $this->Cell(70,4,"  If YES, give details (country):",'LR',1,'L');

                $this->Cell(5,3,"",'L',0,'L',true);            
                $this->Cell(120,3,"",'R',0,'L',true);
                $this->Cell(3,3,"",'L',0,'L');
                $this->SetTextColor(0,0,255);
                $this->Cell(64,3,strtoupper($data->q39_details),'B',0,'L');
                $this->Cell(3,3,"",'R',1,'L');

                $this->Cell(5,1,"",'LB',0,'L',true);            
                $this->Cell(120,1,"",'RB',0,'L',true);
                $this->Cell(70,1,"",'LBR',1,'L');

                $this->SetTextColor(0,0,0);
                $this->Cell(5,4,"40.",'LT',0,'L',true);            
                $this->Cell(120,4,"Pursuant to: (a) Indigenous People's Act (RA 8371); (b) Magna Carta for Disabled Persons (RA",'T',0,'L',true);            
                $this->Cell(70,4,"",'TLR',1,'L');            

                $this->Cell(5,4,"",'L',0,'L',true);            
                $this->Cell(120,4,"7277); and (c) Solo Parents Welfare Act of 2000 (RA 8972), please answer the following items:",0,0,'L',true);            
                $this->Cell(70,4,"",'LR',1,'L');            
                
                $this->Cell(5,4,"a.",'L',0,'L',true);            
                $this->Cell(120,4,"Are you a member of any indigenous group?",'R',0,'L',true);                        
                
                    if($data->q40_a == "yes")
                    $check = "3"; else $check = "";
                    $this->SetFont('ZapfDingbats','', 12);
                    $this->SetTextColor(0,0,255);
                    //$this->Cell(5);
                    $this->Cell(1,4," ".$check, 0, 0);
                    $this->SetTextColor(0,0,0);
                    $this->SetFont('ZapfDingbats','', 10);
                    $this->Cell(4,4, "r",0, 0);
                    $this->SetFont('Arial','',7);
                    $this->SetTextColor(0,0,0);                
                    $this->Cell(10,4,"Yes",0, 0);

                    if($data->q40_a == "no")
                    $check = "3"; else $check = "";
                    $this->SetFont('ZapfDingbats','', 12);
                    $this->SetTextColor(0,0,255);
                    $this->Cell(1,4," ".$check, 0, 0);
                    $this->SetTextColor(0,0,0);
                    $this->SetFont('ZapfDingbats','', 10);
                    $this->Cell(4,4, "r",0, 0);
                    $this->SetFont('Arial','',7);
                    $this->SetTextColor(0,0,0);                
                    $this->Cell(50,4,"No","R", 1,'L');

                $this->Cell(5,4,"",'L',0,'L',true);            
                $this->Cell(120,4,"",'R',0,'L',true);
                $this->Cell(28,4,"  If YES, please specify:",'L',0,'L');
                $this->SetTextColor(0,0,255);
                $this->Cell(39,4,strtoupper($data->q40_a_details),'B',0,'L');
                $this->Cell(3,4,"",'R',1,'L');

                $this->SetTextColor(0,0,0);
                $this->Cell(5,4,"b.",'L',0,'L',true);            
                $this->Cell(120,4,"Are you a person with disability?",'R',0,'L',true);                        
                
                    if($data->q40_b == "yes")
                    $check = "3"; else $check = "";
                    $this->SetFont('ZapfDingbats','', 12);
                    $this->SetTextColor(0,0,255);
                    //$this->Cell(5);
                    $this->Cell(1,4," ".$check, 0, 0);
                    $this->SetTextColor(0,0,0);
                    $this->SetFont('ZapfDingbats','', 10);
                    $this->Cell(4,4, "r",0, 0);
                    $this->SetFont('Arial','',7);
                    $this->SetTextColor(0,0,0);                
                    $this->Cell(10,4,"Yes",0, 0);

                    if($data->q40_b == "no")
                    $check = "3"; else $check = "";
                    $this->SetFont('ZapfDingbats','', 12);
                    $this->SetTextColor(0,0,255);
                    $this->Cell(1,4," ".$check, 0, 0);
                    $this->SetTextColor(0,0,0);
                    $this->SetFont('ZapfDingbats','', 10);
                    $this->Cell(4,4, "r",0, 0);
                    $this->SetFont('Arial','',7);
                    $this->SetTextColor(0,0,0);                
                    $this->Cell(50,4,"No","R", 1,'L');

                $this->Cell(5,4,"",'L',0,'L',true);            
                $this->Cell(120,4,"",'R',0,'L',true);
                $this->Cell(35,4,"  If YES, please specify ID No:",'L',0,'L');
                $this->SetTextColor(0,0,255);
                $this->Cell(32,4,strtoupper($data->q40_b_details),'B',0,'L');
                $this->Cell(3,4,"",'R',1,'L');
                
                $this->SetTextColor(0,0,0);
                $this->Cell(5,4,"c.",'L',0,'L',true);            
                $this->Cell(120,4,"Are you a solo parent?",'R',0,'L',true);                        
                
                    if($data->q40_c == "yes")
                    $check = "3"; else $check = "";
                    $this->SetFont('ZapfDingbats','', 12);
                    $this->SetTextColor(0,0,255);
                    //$this->Cell(5);
                    $this->Cell(1,4," ".$check, 0, 0);
                    $this->SetTextColor(0,0,0);
                    $this->SetFont('ZapfDingbats','', 10);
                    $this->Cell(4,4, "r",0, 0);
                    $this->SetFont('Arial','',7);
                    $this->SetTextColor(0,0,0);                
                    $this->Cell(10,4,"Yes",0, 0);

                    if($data->q40_c == "no")
                    $check = "3"; else $check = "";
                    $this->SetFont('ZapfDingbats','', 12);
                    $this->SetTextColor(0,0,255);
                    $this->Cell(1,4," ".$check, 0, 0);
                    $this->SetTextColor(0,0,0);
                    $this->SetFont('ZapfDingbats','', 10);
                    $this->Cell(4,4, "r",0, 0);
                    $this->SetFont('Arial','',7);
                    $this->SetTextColor(0,0,0);                
                    $this->Cell(50,4,"No","R", 1,'L');

                $this->Cell(5,4,"",'L',0,'L',true);            
                $this->Cell(120,4,"",'R',0,'L',true);
                $this->Cell(35,4,"  If YES, please specify ID No:",'L',0,'L');
                $this->SetTextColor(0,0,255);
                $this->Cell(32,4,strtoupper($data->q40_c_details),'B',0,'L');
                $this->Cell(3,4,"",'R',1,'L');

                $this->Cell(5,1,"",'LB',0,'L',true);            
                $this->Cell(120,1,"",'RB',0,'L',true);
                $this->Cell(70,1,"",'LBR',1,'L');

                $this->SetTextColor(0,0,0);
                $this->SetFont('Arial','',6);            
                $this->Cell(5,5,"41.",'LT',0,'L',true);            
                $this->Cell(16,5,"REFERENCES",'T',0,'L',true); 
                $this->SetTextColor(255,0,0);           
                $this->Cell(124,5,"(Person not related by consanguinity or affinity to applicant /appointee)",'T',0,'L',true);            
                $this->Cell(50,5,"",'TLR',1,'L');
                
                $this->SetTextColor(0,0,0);
                $this->Cell(60,6,"NAME",1,0,'C',true);            
                $this->Cell(65,6,"ADDRESS",1,0,'C',true);            
                $this->Cell(20,6,"TEL. NO.",1,0,'C',true);            
                $this->Cell(10,6,"",'L',0,'L');
                $this->Cell(30,6,"",'TLR',0,'L');
                $this->Cell(10,6,"",'R',1,'L');

                $this->SetTextColor(0,0,255);
                $this->Cell(60,6,strtoupper($data->refname1),1,0,'C');            
                $this->Cell(65,6,strtoupper($data->	refadd1),1,0,'C');            
                $this->Cell(20,6,strtoupper($data->	reftel1),1,0,'C');            
                $this->Cell(10,6,"",'L',0,'L');
                $this->Cell(30,6,"",'LR',0,'L');
                $this->Cell(10,6,"",'R',1,'L');

                $this->Cell(60,6,strtoupper($data->refname2),1,0,'C');            
                $this->Cell(65,6,strtoupper($data->	refadd2),1,0,'C');            
                $this->Cell(20,6,strtoupper($data->	reftel2),1,0,'C');            
                $this->Cell(10,6,"",'L',0,'L');
                $this->Cell(30,6,"",'LR',0,'L');
                $this->Cell(10,6,"",'R',1,'L');

                $this->Cell(60,6,strtoupper($data->refname3),1,0,'C');            
                $this->Cell(65,6,strtoupper($data->	refadd3),1,0,'C');            
                $this->Cell(20,6,strtoupper($data->	reftel3),1,0,'C');            
                $this->Cell(10,6,"",'L',0,'L');
                $this->Cell(30,6,"",'LR',0,'L');
                $this->Cell(10,6,"",'R',1,'L');

                $this->SetTextColor(0,0,0);
                $this->SetFont('Arial','',7.3);
                $this->Cell(5,5,"42.",'LT',0,'L',true);            
                $this->Cell(140,5,"I declare under oath that I have personally accomplished this Personal Data Sheet which is a true, correct and",'T',0,'L',true); 
                $this->Cell(10,5,"",'L',0,'L');
                $this->Cell(30,5,"",'LR',0,'L');
                $this->Cell(10,5,"",'R',1,'L');

                $this->Cell(5,5,"",'L',0,'L',true);            
                $this->Cell(140,5,"complete statement pursuant to the provisions of pertinent laws, rules and regulations of the Republic of the Philippines.",0,0,'L',true); 
                $this->Cell(10,5,"",'L',0,'L');
                $this->Cell(30,5,"",'LR',0,'L');
                $this->Cell(10,5,"",'R',1,'L');

                $this->Cell(5,5,"",'L',0,'L',true);            
                $this->Cell(140,5,"I authorize the agency head / authorized representative to verify/validate the contents stated herein. I  agree that any",0,0,'L',true); 
                $this->Cell(10,5,"",'L',0,'L');
                $this->Cell(30,5,"",'LBR',0,'L');
                $this->Cell(10,5,"",'R',1,'L');

                $this->Cell(5,5,"",'L',0,'L',true);            
                $this->Cell(140,5,"misrepresentation made in this document and its attachments shall cause the filing of administrative/criminal case/s",0,0,'L',true); 
                $this->Cell(10,5,"",'L',0,'L');
                $this->Cell(30,5,"PHOTO",0,0,'C');
                $this->Cell(10,5,"",'R',1,'L');

                $this->Cell(5,5,"",'L',0,'L',true);            
                $this->Cell(140,5,"against me.",0,0,'L',true); 
                $this->Cell(4,5,"",'L',0,'L');
                $this->Cell(42,5,"",'B',0,'C');
                $this->Cell(4,5,"",'R',1,'L');

                $this->Cell(5,2,"",'LB',0,'L',true);            
                $this->Cell(140,2,"",'B',0,'L',true);
                $this->Cell(4,2,"",'L',0,'L');
                $this->Cell(42,2,"",'LR',0,'C');
                $this->Cell(4,2,"",'R',1,'L');

                $this->Cell(5,3,"",'L',0,'L');            
                $this->Cell(140,3,"",0,0,'L'); 
                $this->Cell(4,3,"",0,0,'L');
                $this->Cell(42,3,"",'LR',0,'C');
                $this->Cell(4,3,"",'R',1,'L');

                $this->Cell(3,5,"",'L',0,'L'); 
                $this->SetFont('Arial','',7);           
                $this->Cell(26,5,"Government Issued ID",'LT',0,'L',true); 
                $this->SetFont('Arial','',5);
                $this->Cell(44,5,"(i.e.Passport, GSIS, SSS, PRC, Driver's License, etc.)",'TR',0,'L',true); 
                $this->Cell(4,5,"",0,0,'L');
                $this->Cell(68,5,"",'LT',0,'L');
                $this->Cell(4,5,"",'L',0,'C');
                $this->Cell(42,5,"",'LR',0,'C');
                $this->Cell(4,5,"",'R',1,'L');

                $this->Cell(3,4,"",'L',0,'L'); 
                $this->SetFont('Arial','I',7);           
                $this->Cell(70,4,"PLEASE INDICATE ID Number and Date of Issuance",'LR',0,'L',true); 
                $this->Cell(4,4,"",0,0,'L');
                $this->Cell(68,4,"",'L',0,'L');
                $this->Cell(4,4,"",'L',0,'C');
                $this->Cell(42,4,"",'LR',0,'C');
                $this->Cell(4,4,"",'R',1,'L');

                $this->Cell(3,5,"",'L',0,'L'); 
                $this->SetFont('Arial','',7);           
                $this->Cell(30,5,"Government Issued ID: ",'LT',0,'L'); 
                $this->SetFont('Arial','',7);
                $this->SetTextColor(0,0,255);
                $this->Cell(40,5,strtoupper($data->gov_id),'TR',0,'L'); 
                $this->Cell(4,5,"",0,0,'L');
                $this->Cell(68,5,"",'L',0,'L');
                $this->Cell(4,5,"",'L',0,'C');
                $this->Cell(42,5,"",'LR',0,'C');
                $this->Cell(4,5,"",'R',1,'L');

                $this->Cell(3,2,"",'L',0,'L');             
                $this->Cell(30,2,"",'LT',0,'L');             
                $this->Cell(40,2,"",'TR',0,'L'); 
                $this->Cell(4,2,"",0,0,'L');
                $this->SetFont('Arial','B',10);
                $stmt1 = $db->query("SELECT * FROM personal_info WHERE emp_no='$user_id'");            
                while($data1 = $stmt1->fetch(PDO::FETCH_OBJ)){
                    $this->Cell(68,2,strtoupper($data1->firstname)." ".substr(strtoupper($data1->middlename),0,1).". ".strtoupper($data1->lastname),'L',0,'C');
                }
                //$this->Cell(68,2,"",'L',0,'C');
                $this->Cell(4,2,"",'L',0,'C');
                $this->Cell(42,2,"",'LR',0,'C');
                $this->Cell(4,2,"",'R',1,'L');

                $this->Cell(3,2,"",'L',0,'L'); 
                $this->SetFont('Arial','',7);           
                $this->SetTextColor(0,0,0);
                $this->Cell(30,2,"ID/License/Passport No.: ",'L',0,'L'); 
                $this->SetFont('Arial','',7);
                $this->SetTextColor(0,0,255);
                $this->Cell(40,2,strtoupper($data->gov_id_no),'R',0,'L'); 
                $this->Cell(4,2,"",0,0,'L');
                $this->SetFont('Arial','B',10);              
                $this->Cell(68,2,"",'L',0,'C');
                $this->Cell(4,2,"",'L',0,'C');
                $this->Cell(42,2,"",'LR',0,'C');
                $this->Cell(4,2,"",'R',1,'L');

                $this->Cell(3,3,"",'L',0,'L'); 
                $this->Cell(30,3,"",'L',0,'L'); 
                $this->Cell(40,3,"",'R',0,'L'); 
                $this->Cell(4,3,"",0,0,'L');
                $this->SetFont('Arial','',7); 
                $this->SetTextColor(0,0,0);
                $this->Cell(68,3,"Signature (Sign inside the box)",'LT',0,'C',true);
                $this->Cell(4,3,"",'L',0,'C');
                $this->Cell(42,3,"",'LR',0,'C');
                $this->Cell(4,3,"",'R',1,'L');

                $this->Cell(3,1,"",'L',0,'L');             
                $this->Cell(30,1,"",'LT',0,'L');             
                $this->Cell(40,1,"",'TR',0,'L'); 
                $this->Cell(4,1,"",0,0,'L');
                $this->Cell(68,1,"",'LT',0,'C');
                $this->Cell(4,1,"",'L',0,'C');
                $this->Cell(42,1,"",'LR',0,'C');
                $this->Cell(4,1,"",'R',1,'L');

                $this->Cell(3,2,"",'L',0,'L');   
                $this->SetFont('Arial','',7);           
                $this->SetTextColor(0,0,0);          
                $this->Cell(30,2,"Date/Place of Issuance:",'L',0,'L'); 
                $this->SetTextColor(0,0,255);   
                
                $date_only = substr($data->gov_id_date,0,10);
                $date_final=date_create($date_only);
                $display_date = date_format($date_final,"m/d/Y");

                $place_only = substr($data->gov_id_date,13,strlen($data->gov_id_date));

                $this->Cell(40,2,$display_date.' - '.$place_only,'R',0,'L'); 
                $this->Cell(4,2,"",0,0,'L');   
                $this->Cell(68,2,strtoupper(date("F d, Y")),'L',0,'C');
                $this->Cell(4,2,"",'L',0,'C');
                $this->Cell(42,2,"",'LR',0,'C');
                $this->Cell(4,2,"",'R',1,'L');

                $this->Cell(3,3,"",'L',0,'L'); 
                $this->Cell(30,3,"",'LB',0,'L'); 
                $this->Cell(40,3,"",'RB',0,'L'); 
                $this->Cell(4,3,"",0,0,'L');
                $this->SetFont('Arial','',7); 
                $this->SetTextColor(0,0,0);
                $this->Cell(68,3,"Date Accomplished",'LTB',0,'C',true);
                $this->Cell(4,3,"",'L',0,'C');
                $this->SetFont('Arial','',8);
                $this->Cell(42,3,"Right Thumbmark",'BLTR',0,'C',true);
                $this->Cell(4,3,"",'R',1,'L');

                $this->Cell(195,3,"",'LBR',1,'L');
                $this->Cell(195,5,"",'LTR',1,'L'); 

                $this->SetFont('Arial','',7); 
                $this->Cell(195,3,"SUBSCRIBED AND SWORN to before me this _________________________________, affiant exhibiting his/her validly issued government ID as indicated above.",'LR',1,'C');
                $this->Cell(195,3,"",'LR',1,'C');

                $this->Cell(73,25,"",'LR',0,'C');
                $this->Cell(72,25,"",'LTR',0,'C');
                $this->Cell(50,25,"",'R',1,'C');

                $this->Cell(73,5,"",'LR',0,'C');
                $this->SetFont('Arial','',8); 
                $this->Cell(72,5,"Person Administering Oath",'LTBR',0,'C',true);
                $this->Cell(50,5,"",'R',1,'C');

                $this->Cell(73,3,"",'L',0,'C');            
                $this->Cell(72,3,"",'T',0,'C');
                $this->Cell(50,3,"",'R',1,'C');
                                    
                $this->SetFont('Arial','',5);
                $this->Cell(195,6,"CS FORM 212 (Revised 2017), Page ".$this->PageNo()." of {nb}",1,1,'R');
            }   
        }                 
       
    }


    function continuesheet(){
        $this->SetFont('Arial','I',6);
        $this->SetTextColor(255,0,0);
        $this->SetFillColor(194,194,194);                
        $this->Cell(195,3,'(Continue on separate sheet if necessary)',1,1,'C',true);
    }

    function signature(){
        $this->SetFont('Arial','BI',8);
        $this->SetTextColor(0,0,0);
        $this->SetFillColor(194,194,194);
        $this->Cell(45,10,"SIGNATURE",1,0,'C',true);
        $this->Cell(55,10,"",1,0,'C');
        $this->Cell(15,10,"DATE",1,0,'C',true);
        $this->Cell(35,10,date("F d, Y"),1,0,'C');
        $this->SetFont('Arial','',5);
        $this->Cell(45,10,"CS FORM 212 (Revised 2017), Page ".$this->PageNo()." of {nb}",1,0,'C');
    }

    function footer(){
        $this->Sety(-15);
        $this->SetFont('Arial','',8);
        //$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }

    //Cell with horizontal scaling if text is too wide
    function CellFit($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='', $scale=false, $force=true){
        //Get string width
        $str_width=$this->GetStringWidth($txt);

        //Calculate ratio to fit cell
        if($w==0)
        $w = $this->w-$this->rMargin-$this->x;
        $ratio = ($w-$this->cMargin*2)/$str_width;

        $fit = ($ratio < 1 || ($ratio > 1 && $force));
        if ($fit)
        {
            if ($scale)
            {
                //Calculate horizontal scaling
                $horiz_scale=$ratio*100.0;
                //Set horizontal scaling
                $this->_out(sprintf('BT %.2F Tz ET',$horiz_scale));
            }
            else
            {
                //Calculate character spacing in points
                $char_space=($w-$this->cMargin*2-$str_width)/max(strlen($txt)-1,1)*$this->k;
                //Set character spacing
                $this->_out(sprintf('BT %.2F Tc ET',$char_space));
            }
            //Override user alignment (since text will fill up cell)
            $align='';
        }

        //Pass on to Cell method
        $this->Cell($w,$h,$txt,$border,$ln,$align,$fill,$link);

        //Reset character spacing/horizontal scaling
        if ($fit)
            $this->_out('BT '.($scale ? '100 Tz' : '0 Tc').' ET');
    }

    //Cell with horizontal scaling only if necessary
    function CellFitScale($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link=''){
        $this->CellFit($w,$h,$txt,$border,$ln,$align,$fill,$link,true,false);
    }

    //Cell with horizontal scaling always
    function CellFitScaleForce($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link=''){
        $this->CellFit($w,$h,$txt,$border,$ln,$align,$fill,$link,true,true);
    }

    //Cell with character spacing only if necessary
    function CellFitSpace($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link=''){
        $this->CellFit($w,$h,$txt,$border,$ln,$align,$fill,$link,false,false);
    }

    //Cell with character spacing always
    function CellFitSpaceForce($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link=''){
        //Same as calling CellFit directly
        $this->CellFit($w,$h,$txt,$border,$ln,$align,$fill,$link,false,true);
    }

}

$pdf = new myPDF();
$pdf->AliasNBPages();
$pdf->Addpage('P','legal',0);

/****** PAGE 1 ********/
$pdf->headerTable();
$pdf->personalInfo1($db);
$pdf->address1($db);
$pdf->personalInfo2($db);
$pdf->address2($db);
$pdf->personalInfo3($db);
$pdf->address3($db);
$pdf->personalInfo4($db);
$pdf->address4($db);
$pdf->personalInfo5($db);
$pdf->address5($db);
$pdf->personalInfo6($db);
$pdf->address6($db);
$pdf->personalInfo7($db);
$pdf->address7($db);
$pdf->personalInfo8($db);
$pdf->address8($db);
$pdf->personalInfo9($db);
$pdf->familybackground($db);
$pdf->educationalbackground($db);
$pdf->continuesheet();
$pdf->signature();

/****** PAGE 2 ********/
$pdf->Addpage('P','legal',0);
$pdf->civilservice($db);
$pdf->continuesheet();
$pdf->workexperience($db); 
$pdf->continuesheet();
$pdf->signature();

/****** PAGE 3 ********/
$pdf->Addpage('P','legal',0);
$pdf->voluntary($db);
$pdf->continuesheet();
$pdf->learning($db);
$pdf->continuesheet();
$pdf->otherinfo($db);
$pdf->continuesheet();
$pdf->signature();


/****** PAGE 4 ********/
$pdf->Addpage('P','legal',0);
$pdf->fourthpage($db);

$pdf->Output();

?>