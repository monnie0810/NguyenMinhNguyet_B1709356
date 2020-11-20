
 
 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <!-- start form dang nhap -->
             <form name="Form_dangnhap" id="Form_dangnhap" action="/Du_an_nien_luan/assets/backend/dangnhap.php" method="POST">

                 <div class="modal-header">
                     <h5 class="modal-title title-dangnhap" id="exampleModalLabel">Đăng nhập vào MoonStore.com
                     </h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">

                     <div class="form-group">
                         <label for="recipient-name" class="col-form-label">Số điện thoại:</label>
                         <div class="input-group">
                             <div class="input-group-prepend">
                                 <div class="input-group-text">
                                     <i class="fa fa-mobile" aria-hidden="true"></i>
                                 </div>
                             </div>
                             <input type="text" class="form-control" id="txtsodienthoai" name="txtsodienthoai"
                                 placeholder="Số điện thoại">
                         </div>

                     </div>
                     <div class="form-group">
                         <label for="message-text" class="col-form-label">Mật khẩu:</label>
                         <div class="input-group">
                             <div class="input-group-prepend">
                                 <div class="input-group-text">
                                     <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                                 </div>
                             </div>
                             <input type="password" class="form-control" id="txtmatkhau" name="txtmatkhau"
                                 placeholder="Mật khẩu">
                         </div>
                        
                     </div>
                     <div>
                    
                     </div>

                 </div>
                 <div class="modal-footer">
                     <div class="form-check">
                         <input class="form-check-input" type="checkbox" id="autoSizingCheck2">
                         <label class="form-check-label" for="autoSizingCheck2">
                             Remember me
                         </label>
                     </div>
                     <button type="submit" class="btn btn-outline-primary" name="btn_dangnhap" id="btn_dangnhap">Đăng nhập</button>
                     <a class="btn btn-outline-success" href="/Du_an_nien_luan/backend/pages/dangky.php"
                         role="button">Đăng ký</a>
                 </div>
             </form>
             <!-- end form đăng nhập -->
         </div>
     </div>
 </div>
 <script src="/Du_an_nien_luan/assets/script/dangnhap.js"></script>
 