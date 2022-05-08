            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; SIPEDAS <?= date('Y'); ?> | Rendered in <strong>{elapsed_time}</strong> seconds. <?php echo (ENVIRONMENT === 'development') ?  ' Version <strong>' . CI_VERSION . '</strong>' : '' ?></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

            </div>
            <!-- End of Page Wrapper -->

            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>

            <!-- Logout Modal-->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Keluar App</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Pilih "Keluar" di bawah ini jika Anda siap untuk mengakhiri sesi Anda saat ini.</div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                            <a class="btn btn-info" href="<?= base_url('auth/logout'); ?>">Keluar</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bootstrap core JavaScript-->
            <script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
            <script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

            <!-- Core plugin JavaScript-->
            <script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

            <!-- Custom scripts for all pages-->
            <script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>
            <!-- Page level plugins -->
            <script src="<?= base_url('assets/'); ?>vendor/chart.js/Chart.min.js"></script>

            <script src="<?= base_url(); ?>assets/sweetalert/plugins/sweetalert.min.js"></script>
            <script src="<?= base_url(); ?>assets/sweetalert/js/sweetalert2.all.min.js"></script>

            <!-- Page level plugins -->
            <script src="<?= base_url('assets/'); ?>vendor/datatables/jquery.dataTables.min.js"></script>
            <script src="<?= base_url('assets/'); ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>

            <!-- Page level custom scripts -->
            <script src="<?= base_url('assets/'); ?>js/demo/datatables-demo.js"></script>
            <?php foreach ($perawatan as $row) {
                $total_perawatan = $row['total'];
            } ?>
            <?php foreach ($anggaran as $row) {
                $jan = $row['jan'];
                $feb = $row['feb'];
                $mar = $row['mar'];
                $apr = $row['apr'];
                $mei = $row['mei'];
                $jun = $row['jun'];
                $jul = $row['jul'];
                $agu = $row['ags'];
                $sep = $row['sep'];
                $okt = $row['okt'];
                $nov = $row['nov'];
                $des = $row['des'];
                $total_anggaran = $jan + $feb + $mar + $apr + $mei + $jun + $jul + $agu + $sep + $okt + $nov + $des;
            } ?>
            <script>
                // Set new default font family and font color to mimic Bootstrap's default styling
                Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
                Chart.defaults.global.defaultFontColor = '#858796';

                // Pie Chart Example
                var ctx = document.getElementById("myPieChart");
                var myPieChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ["Perawatan", "Anggaran", "Sisa"],
                        datasets: [{
                            data: [<?= $total_perawatan; ?>, <?= $total_anggaran; ?>, <?= $total_anggaran - $total_perawatan; ?>],
                            backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                            hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                            hoverBorderColor: "rgba(234, 236, 244, 1)",
                        }],
                    },
                    options: {
                        maintainAspectRatio: false,
                        tooltips: {
                            backgroundColor: "rgb(255,255,255)",
                            bodyFontColor: "#858796",
                            borderColor: '#dddfeb',
                            borderWidth: 1,
                            xPadding: 15,
                            yPadding: 15,
                            displayColors: false,
                            caretPadding: 10,
                        },
                        legend: {
                            display: false
                        },
                        cutoutPercentage: 80,
                    },
                });
            </script>

            <script>
                // Set new default font family and font color to mimic Bootstrap's default styling
                Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
                Chart.defaults.global.defaultFontColor = '#858796';

                function number_format(number, decimals, dec_point, thousands_sep) {
                    // *     example: number_format(1234.56, 2, ',', ' ');
                    // *     return: '1 234,56'
                    number = (number + '').replace(',', '').replace(' ', '');
                    var n = !isFinite(+number) ? 0 : +number,
                        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                        s = '',
                        toFixedFix = function(n, prec) {
                            var k = Math.pow(10, prec);
                            return '' + Math.round(n * k) / k;
                        };
                    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
                    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
                    if (s[0].length > 3) {
                        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
                    }
                    if ((s[1] || '').length < prec) {
                        s[1] = s[1] || '';
                        s[1] += new Array(prec - s[1].length + 1).join('0');
                    }
                    return s.join(dec);
                }

                // Area Chart Example
                var ctx = document.getElementById("myAreaChart");
                var myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                        datasets: [{
                            label: "Total ",
                            lineTension: 0.3,
                            backgroundColor: "rgba(78, 115, 223, 0.05)",
                            borderColor: "rgba(78, 115, 223, 1)",
                            pointRadius: 3,
                            pointBackgroundColor: "rgba(78, 115, 223, 1)",
                            pointBorderColor: "rgba(78, 115, 223, 1)",
                            pointHoverRadius: 3,
                            pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                            pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                            pointHitRadius: 10,
                            pointBorderWidth: 2,
                            data: [2540, 10000, 5000, 15000, 10000, 20000, 15000, 25000, 20000, 30000, 25000, 40000],
                        }],
                    },
                    options: {
                        maintainAspectRatio: false,
                        layout: {
                            padding: {
                                left: 10,
                                right: 25,
                                top: 25,
                                bottom: 0
                            }
                        },
                        scales: {
                            xAxes: [{
                                time: {
                                    unit: 'date'
                                },
                                gridLines: {
                                    display: false,
                                    drawBorder: false
                                },
                                ticks: {
                                    maxTicksLimit: 7
                                }
                            }],
                            yAxes: [{
                                ticks: {
                                    maxTicksLimit: 5,
                                    padding: 10,
                                    // Include a dollar sign in the ticks
                                    callback: function(value, index, values) {
                                        return ' Rp. ' + number_format(value);
                                    }
                                },
                                gridLines: {
                                    color: "rgb(234, 236, 244)",
                                    zeroLineColor: "rgb(234, 236, 244)",
                                    drawBorder: false,
                                    borderDash: [2],
                                    zeroLineBorderDash: [2]
                                }
                            }],
                        },
                        legend: {
                            display: false
                        },
                        tooltips: {
                            backgroundColor: "rgb(255,255,255)",
                            bodyFontColor: "#858796",
                            titleMarginBottom: 10,
                            titleFontColor: '#6e707e',
                            titleFontSize: 14,
                            borderColor: '#dddfeb',
                            borderWidth: 1,
                            xPadding: 15,
                            yPadding: 15,
                            displayColors: false,
                            intersect: false,
                            mode: 'index',
                            caretPadding: 10,
                            callbacks: {
                                label: function(tooltipItem, chart) {
                                    var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                                    return datasetLabel + ': Rp. ' + number_format(tooltipItem.yLabel);
                                }
                            }
                        }
                    }
                });
            </script>

            <script>
                $('.custom-file-input').on('change', function() {
                    let fileName = $(this).val().split('\\').pop();
                    $(this).next('.custom-file-label').addClass("selected").html(fileName);
                });

                $('.form-check-input').on('click', function() {
                    const menuId = $(this).data('menu');
                    const roleId = $(this).data('role');

                    $.ajax({
                        url: "<?= base_url('admin/changeaccess'); ?>",
                        type: 'post',
                        data: {
                            menuId: menuId,
                            roleId: roleId
                        },
                        success: function() {
                            document.location.href = "<?= base_url('admin/roleaccess/'); ?>" + roleId;
                        }
                    });

                });
            </script>

            <script>
                // +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                // Detail Kendaraan
                $(document).ready(function() {
                    $('#nomor_polisi').change(function() {
                        var nomor_polisi = $(this).val();

                        $.ajax({
                            url: "<?= base_url('transaksi/get_nomor_polisi'); ?>",
                            method: "POST",
                            data: {
                                nomor_polisi: nomor_polisi
                            },
                            async: false,
                            dataType: 'json',
                            success: function(data) {
                                var html = '';
                                var i;
                                for (i = 0; i < data.length; i++) {


                                    html += '<div class="card mb-4 shadow"><div class="card-header">Detail Kendaraan</div><div class="card-body">';

                                    html += '<div class="row gx-3 mb-3"><div class="col-md-2"><label class="small mb-1">Nomor Polisi</label><input class="form-control" type="text" value="' + data[i].nomor_polisi + '" readonly></div><div class="col-md-5"><label class="small mb-1">Nama Pemilik</label><input class="form-control" type="text" value="' + data[i].nama_pemilik + '" readonly></div><div class="col-md-5"><label class="small mb-1">Pengguna Kendaraan</label><input class="form-control" type="text" value="' + data[i].pengguna_kendaraan + '" readonly></div></div>';

                                    html += '<div class="mb-3"><label class="small mb-1">Alamat</label><input class="form-control" type="text" value="' + data[i].alamat + '"readonly></div>';

                                    html += '<div class="row gx-3 mb-3"><div class="col-md-3"><label class="small mb-1">Merek</label><input class="form-control" type="text" value="' + data[i].nama_jenis_kendaraan + '" readonly></div><div class="col-md-3"><label class="small mb-1">Type</label><input class="form-control" type="text" value="' + data[i].type + '"readonly></div><div class="col-md-3"><label class="small mb-1">Jenis</label><input class="form-control" type="text" value="' + data[i].jenis + '" readonly></div><div class="col-md-3"><label class="small mb-1">Model</label><input class="form-control" type="text" value="' + data[i].model + '"readonly></div></div>';

                                    html += '<div class="row gx-3 mb-3"><div class="col-md-3"><label class="small mb-1">Tahun Pembuatan</label><input class="form-control" type="text" value="' + data[i].tahun_pembuatan + '" readonly></div><div class="col-md-3"><label class="small mb-1">Isi Silinder</label><input class="form-control" type="text" value="' + data[i].silinder + '"readonly></div><div class="col-md-3"><label class="small mb-1">Nomor Rangka</label><input class="form-control" type="text" value="' + data[i].nomor_rangka + '" readonly></div><div class="col-md-3"><label class="small mb-1">Nomor Mesin</label><input class="form-control" type="text" value="' + data[i].nomor_mesin + '"readonly></div></div>';

                                    html += '<div class="row gx-3 mb-3"><div class="col-md-3"><label class="small mb-1">Warna</label><input class="form-control" type="text" value="' + data[i].warna + '" readonly></div><div class="col-md-3"><label class="small mb-1">Tahun Registrasi</label><input class="form-control" type="text" value="' + data[i].tahun_registrasi + '"readonly></div><div class="col-md-3"><label class="small mb-1">Nomor BPKB</label><input class="form-control" type="text" value="' + data[i].nomor_bpkb + '" readonly></div><div class="col-md-3"><label class="small mb-1">Tanggal Berlaku</label><input class="form-control" type="text" value="' + data[i].tanggal_berlaku + '"readonly></div></div>';


                                    html += ' </div></div>';
                                }
                                $('.identitas_kendaraan').html(html);

                            }
                        });
                    });
                });
                //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                // end Detail Kendaraan

                //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                // Transaksi
                $(document).ready(function() {

                    $("#btn-tambah-form").click(function() {

                        var jumlah = parseInt($("#jumlah-form").val());
                        var nextform = jumlah + 1;
                        $("#insert-form").append(
                            '<table id="dataTable1' + nextform + '" class="table table-bordered table-hover display" style="width:100%"> ' +
                            '<tbody>' +
                            '<tr>' +
                            '<td style="width:3%">' +
                            '' + nextform + '' +
                            '</td>' +

                            '<td style="width:40%">' +
                            '<input type="text" required name="nama_barang[]" class="form-control" id="nama_barang" autocomplete="off">' +
                            '</td>' +

                            '<td style="width:10%">' +
                            '<input type="text" required name="volume[]"  class="form-control volume" id="volume" onkeyup="sum();" autocomplete="off">' +
                            '</td>' +

                            '<td style="width:10%">' +
                            '<input type="text" required name="satuan[]"  class="form-control" id="satuan" autocomplete="off">' +
                            '</td>' +

                            '<td style="width:10%">' +
                            '<input type="text" required name="harga[]"  class="form-control harga" id="harga" onkeyup="sum();" autocomplete="off">' +
                            '</td>' +

                            // '<td style="width:10%">' +
                            // '<input type="text" required name="jumlah[]"  class="form-control jumlah" readonly id="jumlah" autocomplete="off">' +
                            // '</td>' +


                            '<td style="width:10%">' +
                            '<center><button type="button" class="btn btn-danger btn-icon-split btn-sm" onclick="removeRow(' + nextform + ')"><span class="icon text-white-50"><i class="fas fa-times"></i></span><span class="text">Remove</span></button></center>' +
                            '</td>' +

                            '</tr>' +
                            '</tbody>' +
                            '</table>'
                        );
                        $("#jumlah-form").val(nextform);
                    });

                });

                function removeRow(nextform) {
                    $("#dataTable1" + nextform).remove();
                }


                function sum(nextform) {
                    var volume = document.getElementById('volume').value;
                    var harga = document.getElementById('harga').value;
                    var result = parseInt(volume) * parseInt(harga);
                    if (!isNaN(result)) {
                        document.getElementById('jumlah').value = result;
                    }
                }
                //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                // End Transaksi

                // tombol-hapus
                $('.tombol-hapus').on('click', function(e) {

                    e.preventDefault();
                    const href = $(this).attr('href');

                    Swal({
                        title: 'Are you sure',
                        text: "data will be deleted",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Delete'
                    }).then((result) => {
                        if (result.value) {
                            document.location.href = href;
                        }
                    })

                });
                // end hapus



                // +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                // Detail Anggaran
                // $(document).ready(function() {
                //     $('#kode_akun').change(function() {
                //         var kode_akun = $(this).val();

                //         $.ajax({
                //             url: "<?= base_url('transaksi/get_kode_akun_anggaran'); ?>",
                //             method: "POST",
                //             data: {
                //                 kode_akun: kode_akun
                //             },
                //             async: false,
                //             dataType: 'json',
                //             success: function(respone) {
                //                 var html = '';
                //                 var i;
                //                 for (i = 0; i < respone.length; i++) {


                //                     html += '<div class="card shadow mb-4 identitas_anggaran"><div class="card-header py-3"><h6 class="m-0 font-weight-bold">Informasi Anggaran Pertahun</h6></div><div class="card-body"><div class="row gx-3 mb-3"><div class="col-md-4"><label class="small mb-1">Pagu Anggaran</label><input class="form-control" value="' + respone[i].jan + '" type="text" readonly></div><div class="col-md-4"><label class="small mb-1">Realisasi</label><input class="form-control" type="text" readonly></div><div class="col-md-4"><label class="small mb-1">Sisa Anggaran</label><input class="form-control" type="text" readonly></div></div></div></div>';

                //                     // html += '<div class="card shadow mb-4 identitas_anggaran"><div class="card-header py-3"><h6 class="m-0 font-weight-bold">Informasi Anggaran Pertahun</h6></div><div class="card-body"><div class="row gx-3 mb-3"><div class="col-md-4"><label class="small mb-1">Pagu Anggaran</label><input class="form-control" type="text" readonly></div><div class="col-md-4"><label class="small mb-1">Realisasi</label><input class="form-control" type="text" readonly></div><div class="col-md-4"><label class="small mb-1">Sisa Anggaran</label><input class="form-control" type="text" readonly></div></div></div></div>';

                //                 }
                //                 $('.identitas_anggaran').html(html);

                //             }
                //         });
                //     });
                // });
                //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                // end Detail Anggaran


                // tombol-aprov
                $('.aprov').on('click', function(e) {

                    e.preventDefault();
                    const href = $(this).attr('href');

                    Swal({
                        title: 'Are you sure',
                        text: "data will be aproved",
                        type: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes'
                    }).then((result) => {
                        if (result.value) {
                            document.location.href = href;
                        }
                    })

                });
                // end aprov
                $(document).ready(function() {
                    $('.btn_cetak_kendaraan').on("click", function(e) {
                        var base_url = '<?= base_url(); ?>';
                        var id_merek = $('.id_merek').val();
                        var tanggal_awal = $('.tanggal_awal').val();
                        var tanggal_akhir = $('.tanggal_akhir').val();
                        window.open(base_url + 'laporan/cetak_kendaraan/' + id_merek + '/' + tanggal_awal + '/' + tanggal_akhir, '_blank');
                    });

                    $('.btn_cetak_perawatan').on("click", function(e) {
                        var base_url = '<?= base_url(); ?>';
                        var jenis_perawatan = $('.jenis_perawatan').val();
                        var tanggal_awal_perawatan = $('.tanggal_awal_perawatan').val();
                        var tanggal_akhir_perawatan = $('.tanggal_akhir_perawatan').val();
                        window.open(base_url + 'laporan/cetak_perawatan/' + jenis_perawatan + '/' + tanggal_awal_perawatan + '/' + tanggal_akhir_perawatan, '_blank');
                    });

                });
            </script>




            </body>

            </html>