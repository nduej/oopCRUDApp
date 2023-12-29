<?php

include_once 'lib/db.php';
class Register
{
    public $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    //Uploading of Registered Students
    public function addRegister($data, $file)
    {
        $name = $data['name'];
        $email = $data['email'];
        $phone = $data['phone'];
        $address = $data['address'];

        $permitted = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $file['photo']['name'];
        $file_size = $file['photo']['size'];
        $file_tmp = $file['photo']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_img = substr(md5(rand()), 0, 10) . '.' . $file_ext;
        $upload_img = "uploads/" . $unique_img;


        if (empty($name) || empty($email) || empty($phone) || empty($address) || empty($file_name)) {
            $msg = "Fields Must Not be Empty!";
            return $msg;
        } elseif ($file_size > 1048567) {
            $msg = "File Size Should be Less than 1MB!";
            return $msg;
        } elseif (in_array($file_ext, $permitted) == false) {
            $msg = "You can Upload only!" . implode(',', $permitted);
            return $msg;
        } else {
            move_uploaded_file($file_tmp, $upload_img);

            $query = "INSERT INTO `tbl_register`(`name`, `email`, `phone`, `photo`, `address`) 
                      VALUES ('$name', '$email', '$phone', '$upload_img', '$address')";

            $result = $this->db->insert($query);

            if ($result) {
                $msg = "Registration Successful!";
                return $msg;
            } else {
                $msg = "Registration Failed!";
                return $msg;
            }
        }
    }

    //Calling all Students Registered in the database!!
    public function allStudent()
    {
        $query = "SELECT * FROM tbl_register ORDER BY id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    // Editing of Students Information
    public function getStdById($id)
    {
        $query = "SELECT * FROM tbl_register WHERE id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    //Update Student
    public function updateStudent($data, $file, $id)
    {
        $name = $data['name'];
        $email = $data['email'];
        $phone = $data['phone'];
        $address = $data['address'];

        $permitted = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $file['photo']['name'];
        $file_size = $file['photo']['size'];
        $file_tmp = $file['photo']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_img = substr(md5(rand()), 0, 10) . '.' . $file_ext;
        $upload_img = "uploads/" . $unique_img;


        if (empty($name) || empty($email) || empty($phone) || empty($address)) {
            $msg = "Fields Must Not be Empty!";
            return $msg;
        }
        if (!empty($file_name)) {
            if ($file_size > 1048567) {
                $msg = "File Size Should be Less than 1MB!";
                return $msg;
            } elseif (in_array($file_ext, $permitted) == false) {
                $msg = "You can Upload only!" . implode(',', $permitted);
                return $msg;
            } else {

                $img_query = "SELECT * FROM tbl_register WHERE id = '$id'";
                $img_res = $this->db->select($img_query);
                if($img_res){
                    while($row = mysqli_fetch_assoc($img_res)){
                        $photo = $row['photo'];
                        unlink($photo);
                    }
                }


                move_uploaded_file($file_tmp, $upload_img);

                $query = "UPDATE tbl_register SET name='$name', email='$email', phone='$phone', photo='$upload_img', address='$address'
                          WHERE id='$id'";

                $result = $this->db->update($query);

                if ($result) {
                    $msg = "Update Successful!";
                    return $msg;
                } else {
                    $msg = "Update Failed!";
                    return $msg;
                }
            }
        } else {
            $query = "UPDATE tbl_register SET name='$name', email='$email', phone='$phone', address='$address'
            WHERE id='$id'";

            $result = $this->db->update($query);

            if ($result) {
                $msg = "Update Successful!";
                return $msg;
            } else {
                $msg = "Update Failed!";
                return $msg;
            }
        }

    }

    //Delete Student
    public function delStudent($id){
        $img_query = "SELECT * FROM tbl_register WHERE id = '$id'";
        $img_res = $this->db->select($img_query);
        if($img_res){
            while($row = mysqli_fetch_assoc($img_res)){
                $photo = $row['photo'];
                unlink($photo);
            }
        }

        $del_query = "DELETE FROM tbl_register WHERE id = '$id'";
        $del = $this->db->delete($del_query);
        if ($del) {
            $msg = "Student Deleted Successfully!";
            return $msg;
        } else{
            $msg = "Delete Failed!";
            return $msg;
        }

    }


}


