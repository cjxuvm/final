< ? php
if ( isset ( $_POST['submit'] ) ) {  
    if ( isset ( $_POST['怪談名稱'] ) && isset ( $_POST['出沒地區'] ) && 
        isset ( $_POST['時期'] ) && isset ( $_POST['怪談故事'] ) &&
        isset ( $_POST['相關圖片'] ) ) { 
        
        $username = $_POST['怪談名稱'] ;
        $password = $_POST['出沒地區'] ;
        $gender = $_POST['gender'] ;
        $email = $_POST['email'] ;
        $phoneCode = $_POST['phoneCode'] ;
        $phone = $_POST['phone'] ;
        $host = "本地主機" ;
        $dbUsername = "root" ;
        $dbPassword = "" ;
        $dbName = "測試" ;
        $conn = new mysqli ( $host, $dbUsername, $dbPassword, $dbName ) ;    
        如果（$conn->connect_error ）{  
            die ( '無法連接到數據庫。' ) ;
        }
        其他{ 
            $Select = "SELECT email FROM register WHERE email = ? LIMIT 1" ;
            $Insert = "INSERT INTO register(username, password,gender, email, phoneCode, phone) values(?, ?, ?, ?, ?, ?)" ;
            $stmt = $conn->prepare ( $Select ) ;
            $stmt->bind_param ( "s" , $email ) ;
            $stmt->execute () ;
            $stmt->bind_result ( $resultEmail ) ;
            $stmt->store_result () ;
            $stmt->fetch () ;
            $rnum = $stmt->num_rows ;
            如果（$rnum == 0 ）{  
                $stmt->close () ;
                $stmt = $conn->prepare ( $Insert ) ;
                $stmt->bind_param ( "ssssii" , $username, $password, $gender, $email, $phoneCode, $phone ) ;     
                if ( $stmt->execute ()) {  
                    echo "新記錄插入成功。" ; 
                }
                其他{ 
                    echo $stmt->error ; 
                }
            }
            其他{ 
                echo "有人已經使用這個郵箱註冊了。" ; 
            }
            $stmt->close () ;
            $conn->close () ;
        }
    }
    其他{ 
        echo "所有字段都是必需的。" ; 
        死() ;
    }
}
其他{ 
    echo "提交按鈕未設置" ; 
}
? >