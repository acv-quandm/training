<template>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Danh sách người dùng</h3>
        </div>
        <div style="padding-bottom: 10px;">
            <button class="btn btn-danger ds-bt" @click="xoa_muc_da_chon()">Xóa mục đã chọn</button>
            <button class="btn btn-success ds-bt">Lưu</button>
            <button class="btn btn-info ds-bt" @click="show_them_moi()">Thêm mới</button>
        </div>
        <div class="clearfix"></div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>

                    <th><input type="checkbox" v-model="check_all" @change="un_all()"></th>
                    <th>Nội dung</th>
                    <th>Trạng thái</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(nguoi_dung,index) in toan_bo_nguoi_dung">
                    <td>
                        <input type="checkbox" :value="nguoi_dung.id" v-model="id_da_chon" @change="click()">
                    </td>

                    <td>
                        <a href="#" @click="get_du_lieu_nguoi_dung(nguoi_dung.id)">{{nguoi_dung.ho + " " + nguoi_dung.ten}}</a>
                    </td>
                    <td>

                        <select name="" id="" class="form-control" v-if="nguoi_dung.trang_thai == 1" style="width: 100%">
                            <option value="1" selected>Hiển thị</option>

                            <option value="0">Không hiển thị</option>
                        </select>
                        <select name=""  class="form-control"  v-else style="width: 100%">
                            <option value="1" >Hiển thị</option>

                            <option value="0" selected>Không hiển thị</option>
                        </select>
                    </td>

                </tr>

                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
        <div class="modal fade" id="modal-thong-tin-nguoi-dung" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header"  style="background-color: #00a157">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title" style="color: #e6ffef">Thông tin người dùng</h4>
                    </div>
                    <div class="modal-body">
                        <form action="#">
                            <div class="form-group">
                                <label for="">
                                    Họ
                                </label>
                                <input type="text" class="form-control" name="ho" v-model="du_lieu_nguoi_dung.ho">
                            </div>
                            <div class="form-group">
                                <label for="">
                                    Tên
                                </label>
                                <input type="text" class="form-control" name="ho" v-model="du_lieu_nguoi_dung.ten">
                            </div>
                            <div class="form-group">
                                <label for="">
                                    Địa chỉ
                                </label>
                                <input type="text" class="form-control" name="ho" v-model="du_lieu_nguoi_dung.dia_chi">
                            </div>
                            <div class="form-group">
                                <label for="">
                                    Tài khoản
                                </label>
                                <input type="text" disabled class="form-control" v-bind:value="du_lieu_nguoi_dung.tai_khoan">
                            </div>
                            <div class="form-group">
                                <label for="">
                                    Mật khẩu
                                </label>
                                <input type="password" class="form-control" name="ho" v-model="du_lieu_nguoi_dung.mat_khau">
                            </div>
                            <div class="form-group">
                                <label for="">
                                   Trạng thái
                                </label>
                                <select name="" class="form-control" v-model="du_lieu_nguoi_dung.trang_thai">
                                    <option value="1"> Hiển thị</option>
                                    <option value="0"> Không hiển thị</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="luu_chinh_sua()">Lưu chỉnh sửa</button>
                        <button type="button" class="btn btn-danger" @click="xoa_nguoi_dung()">Xóa người dùng</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <div class="modal fade" id="modal-them-moi" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header"  style="background-color: #0b93d5">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title" style="color: #e6ffef">Thêm mới người dùng</h4>
                    </div>
                    <div class="modal-body">
                        <form action="#">
                            <div class="form-group">
                                <label for="">
                                    Họ
                                </label>
                                <input type="text" placeholder="Họ" class="form-control"  v-model="them_moi.ho">
                            </div>
                            <div class="form-group">
                                <label for="">
                                    Tên
                                </label>
                                <input type="text" placeholder="Tên" class="form-control"  v-model="them_moi.ten">
                            </div>
                            <div class="form-group">
                                <label for="">
                                    Địa chỉ
                                </label>
                                <input type="text" placeholder="Địa chỉ" class="form-control" v-model="them_moi.dia_chi">
                            </div>
                            <div class="form-group">
                                <label for="">
                                    Tài khoản
                                </label>
                                <input type="text" placeholder="Tài khoản" class="form-control" v-model="them_moi.tai_khoan">
                            </div>
                            <div class="form-group">
                                <label for="">
                                    Mật khẩu
                                </label>
                                <input type="password" placeholder="Mật khẩu" class="form-control" v-model="them_moi.mat_khau">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="them_moi_nguoi_dung()">Thêm mới người dùng</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>
</template>
<script>
    export default {
        created(){
            this.laydulieu()

        },
        data(){
            return {
                toan_bo_nguoi_dung : [],
                id_da_chon : [],
                check_all: false,
                du_lieu_nguoi_dung: [],
                danh_sach_trang_thai: [],
                them_moi: []
            }
        },
        methods:{
            laydulieu(){
                axios.get("/api/nguoi-dung").then((res) => {
                    this.toan_bo_nguoi_dung = res.data
                    this.danh_sach_trang_thai = this.toan_bo_nguoi_dung.map((value) => {
                        return {id: value.id,trang_thai : value.trang_thai}
                    })
                    console.log(this.danh_sach_trang_thai)
                })
            },
            click(){
                if(this.id_da_chon.length == this.toan_bo_nguoi_dung.length)
                {
                    this.check_all = true
                }
                else
                {
                    this.check_all = false
                }
            },
            un_all(){
               if(this.check_all == true)
               {
                   var td = this.id_da_chon
                   this.toan_bo_nguoi_dung.forEach(function (value,index){
                       td.push(value.id)
                   })
               }else
               {

                   this.id_da_chon = []
               }
            },
            get_du_lieu_nguoi_dung(id){
                axios.get("/api/nguoi-dung/"+id).then((res) => {
                    this.du_lieu_nguoi_dung = res.data
                    this.du_lieu_nguoi_dung.mat_khau = ''
                    $("#modal-thong-tin-nguoi-dung").modal("show")
                })
            },
            luu_chinh_sua(){
                if(this.du_lieu_nguoi_dung.mat_khau != '')
                {
                    axios.put("/api/nguoi-dung/"+this.du_lieu_nguoi_dung.id,{

                        ho: this.du_lieu_nguoi_dung.ho,
                        ten: this.du_lieu_nguoi_dung.ten,
                        dia_chi: this.du_lieu_nguoi_dung.dia_chi,
                        mat_khau: this.du_lieu_nguoi_dung.mat_khau,
                        trang_thai: this.du_lieu_nguoi_dung.trang_thai

                    }).then((res) => {
                        if(res.data.sc == true)
                        {
                            console.log("thành công")
                            $("#modal-thong-tin-nguoi-dung").modal("hide")
                            this.laydulieu()
                        }
                        else
                        {
                            console.log(res)
                        }
                    }).catch((err) => {
                        console.log(err)
                    })
                }
                else {
                    axios.put("/api/nguoi-dung/"+this.du_lieu_nguoi_dung.id,{

                        ho: this.du_lieu_nguoi_dung.ho,
                        ten: this.du_lieu_nguoi_dung.ten,
                        dia_chi: this.du_lieu_nguoi_dung.dia_chi,
                        trang_thai: this.du_lieu_nguoi_dung.trang_thai

                    }).then((res) => {
                        if(res.data.sc == true)
                        {
                            console.log("thành công")
                            $("#modal-thong-tin-nguoi-dung").modal("hide")
                            this.laydulieu()
                        }
                        else
                        {
                            console.log(res)
                        }
                    }).catch((err) => {
                        console.log(err)
                    })
                }

            },
            xoa_nguoi_dung(){
                axios.delete("/api/nguoi-dung/"+this.du_lieu_nguoi_dung.id).then((sc) => {
                    if(sc.data.sc == true)
                    {
                        console.log("thành công")
                        $("#modal-thong-tin-nguoi-dung").modal("hide")
                        this.laydulieu()

                    }
                })
            }
        ,
            xoa_muc_da_chon(){
                console.log(this.id_da_chon)
                for(var i = 0; i< this.id_da_chon.length;i++)
                {

                    axios.delete("/api/nguoi-dung/"+this.id_da_chon[i]).then((sc) => {
                        if(sc.data.sc == true)
                        {
                            console.log("thành công")
                        }
                    })

                    this.toan_bo_nguoi_dung = this.reset_dulieu(this.id_da_chon[i])
                }

                this.id_da_chon = []
                this.check_all = false

            },
            reset_dulieu(gia_tri){

                var gt = []
                for(var i = 0;i< this.toan_bo_nguoi_dung.length;i++)
                {
                    if(this.toan_bo_nguoi_dung[i].id != gia_tri)
                    {
                        gt.push(this.toan_bo_nguoi_dung[i])
                    }
                }
                return gt;
            },
            show_them_moi(){
                $("#modal-them-moi").modal("show")
            },
            them_moi_nguoi_dung(){
                axios.post("/api/nguoi-dung",{
                    ho: this.them_moi.ho,
                    ten: this.them_moi.ten,
                    dia_chi: this.them_moi.dia_chi,
                    mat_khau: this.them_moi.mat_khau,
                    tai_khoan: this.them_moi.tai_khoan
                }).then((sc) => {
                    if(sc.data.sc == true)
                    {
                        console.log("thành công")
                        $("#modal-them-moi").modal("hide")
                        this.laydulieu()

                    }
                })
            }
        }
    }
</script>