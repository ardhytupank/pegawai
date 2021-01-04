<?php

date_default_timezone_set('Asia/Jakarta');
$riwayat = date('Y-m-d H:i:s');

require_once 'code.php';

if ($hh > $kk) {
  echo $say;
} else {

  // date_default_timezone_set('Asia/Jakarta');
  // $riwayat = date('Y-m-d H:i:s');

  if (isset($_POST['simpan_barang'])) {
  } elseif (isset($_POST['tambah_master_barang'])) {

    $nama_barang = strtoupper(htmlspecialchars($_POST['nama_barang']));
    $id_jenis_barang = $_POST['id_jenis_barang'];
    $jb = $_POST['jb'];
    $nama_jenis_barang = ucfirst(htmlspecialchars($_POST['nama_jenis_barang']));

    // $nama_file = $_FILES['gambar']['name'];
    // $tipe_file = $_FILES['gambar']['type'];
    // $ukuran_file = $_FILES['gambar']['size'];
    // $error = $_FILES['gambar']['error'];
    // $tmp_file = $_FILES['gambar']['tmp_name'];

    // $daftar_gambar = ['jpg', 'jpeg', 'png'];
    // $ekstensi_file = explode('.', $nama_file);
    // $ekstensi_file = strtolower(end($ekstensi_file));

    $bs = $_POST['bs'];
    $nama_bentuk_sediaan = strtoupper(htmlspecialchars($_POST['nama_bentuk_sediaan']));
    $id_bentuk_sediaan = $_POST['id_bentuk_sediaan'];

    // if (!in_array($ekstensi_file, $daftar_gambar)) {
    //   echo "<strong><p style='color: red; font-style: italic;'>Yang anda pilih bukan gambar!</p></strong>";
    // } elseif ($tipe_file != 'image/jpeg' && $tipe_file != 'image/png') {
    //   echo "<strong><p style='color: red; font-style: italic;'>Yang anda pilih bukan gambar!</p></strong>";
    // } elseif ($ukuran_file > 5000000) {
    //   echo "<strong><p style='color: red; font-style: italic;'>Ukuran gambar terlalu besar!</p></strong>";
    // } else {

    //PILIH BENTUK SEDIAAN
    if ($bs == 1) {
      if (empty($id_bentuk_sediaan)) {
        echo "<h4><span class='label label-danger'>Bentuk Sediaan Belum Diinput Sebelumnya!</h4></span>";
      } else {

        //PILIH JENIS BARANG
        if ($jb == 1) {
          if (empty($nama_barang) || empty($id_jenis_barang)) {
            echo "<strong><p style='color: red; font-style: italic;'>Data tidak boleh kosong!</p></strong>";
          } else {

            $lihat = mysqli_fetch_assoc(
              mysqli_query(
                $konek,
                "SELECT * FROM code WHERE id_code = 1"
              )
            );
            $jumlah = $lihat['jumlah'] + 1;
            $id_code = $lihat['id_code'];
            $kode_barang = 'BR0' . $jumlah;

            $simpan_barang = mysqli_query(
              $konek,
              "INSERT INTO
              barang
              VALUES('$kode_barang',
              '$nama_barang',
              '$id_jenis_barang',
              '$id_bentuk_sediaan',
              '',
              '',
              '',
              '$_SESSION[id_user]',
              '$riwayat')"
            );
            if ($simpan_barang) {
              $u_code = mysqli_query(
                $konek,
                "UPDATE code SET jumlah = '$jumlah' WHERE id_code = '$id_code'"
              );
              if ($u_code) {

                // $nama_file_baru = uniqid();
                // $nama_file_baru .= '.';
                // $nama_file_baru .= $ekstensi_file;
                // $pindah = move_uploaded_file($tmp_file, 'img/' . $nama_file_baru);

                //if ($pindah) {
                // $simpan_gambar = mysqli_query(
                //   $konek,
                //   "INSERT INTO gambar_barang VALUES(null,'$kode_barang','$nama_file_baru')"
                // );
                // if ($simpan_gambar) {
                echo "<strong><p style='color: green; font-style: italic;'>Simpan Berhasil</p></strong>";
                // } else {
                //   echo "<strong><p style='color: red; font-style: italic;'>Simpan gambar gagal<br>" . mysqli_error($konek) . '</p></strong>';
                // }
                // } else {
                //   echo "<strong><p style='color: red; font-style: italic;'>Gambar gagal dipindah<br>" . mysqli_error($konek) . '</p></strong>';
                // }
              } else {
                echo "<strong><p style='color: red; font-style: italic;'>Update kode gagal<br>" . mysqli_error($konek) . '</p></strong>';
              }
            } else {
              echo "<strong><p style='color: red; font-style: italic;'>Simpan barang gagal<br>" . mysqli_error($konek) . '</p></strong>';
            }
          }
          //echo "Jenis barang dipilih";
        }
        //CREATE JENIS BARANG
        else {
          if (empty($nama_jenis_barang) || empty($nama_barang)) {
            echo "<strong><p style='color: red; font-style: italic;'>Data tidak boleh kosong!</p></strong>";
          } else {
            $simpan_jenis_barang = mysqli_query(
              $konek,
              "INSERT INTO jenis_barang VALUES(null,'$nama_jenis_barang')"
            );
            $id_jb = mysqli_insert_id($konek);
            if ($simpan_jenis_barang) {
              $lihat = mysqli_fetch_assoc(
                mysqli_query(
                  $konek,
                  "SELECT * FROM code WHERE id_code = 1"
                )
              );
              $jumlah = $lihat['jumlah'] + 1;
              $id_code = $lihat['id_code'];
              $kode_barang = 'BR0' . $jumlah;
              $simpan_barang = mysqli_query(
                $konek,
                "INSERT INTO
                barang
                VALUES('$kode_barang',
                '$nama_barang',
                '$id_jb',
                '$id_bentuk_sediaan',
                '',
                '',
                '',
                '$_SESSION[id_user]',
                '$riwayat')"
              );
              if ($simpan_barang) {
                $u_code = mysqli_query(
                  $konek,
                  "UPDATE code SET jumlah = '$jumlah' WHERE id_code = '$id_code'"
                );
                if ($u_code) {

                  // $nama_file_baru = uniqid();
                  // $nama_file_baru .= '.';
                  // $nama_file_baru .= $ekstensi_file;
                  // $pindah = move_uploaded_file($tmp_file, 'img/' . $nama_file_baru);

                  //                if ($pindah) {
                  // $simpan_gambar = mysqli_query(
                  //   $konek,
                  //   "INSERT INTO gambar_barang VALUES(null,'$kode_barang','$nama_file_baru')"
                  // );
                  // if ($simpan_gambar) {
                  echo "<strong><p style='color: green; font-style: italic;'>Simpan Berhasil</p></strong>";
                  // } else {
                  //   echo "<strong><p style='color: red; font-style: italic;'>Simpan gambar gagal<br>" . mysqli_error($konek) . '</p></strong>';
                  // }
                  // } else {
                  //   echo "<strong><p style='color: red; font-style: italic;'>Gambar gagal dipindah<br>" . mysqli_error($konek) . '</p></strong>';
                  // }
                } else {
                  echo "<strong><p style='color: red; font-style: italic;'>Simpan gagal<br>" . mysqli_error($konek) . '</p></strong>';
                }
              } else {
                echo "<strong><p style='color: red; font-style: italic;'>Simpan barang gagal<br>" . mysqli_error($konek) . '</p></strong>';
              }
            } else {
              echo "<strong><p style='color: red; font-style: italic;'>Simpan jenis barang gagal<br>!" . mysqli_error($konek) . '</p></strong>';
            }
          }
        } //tanda

      }
    } else {
      if (empty($nama_bentuk_sediaan)) {
        echo "<h4><span class='label label-danger'>Nama Bentuk Sediaan tidak boleh kosong!</h4></span>";
      } else {
        $simpan_bs = mysqli_query(
          $konek,
          "INSERT INTO bentuk_sediaan VALUES(null,'$nama_bentuk_sediaan')"
        );
        $id_bs = mysqli_insert_id($konek);
        if ($simpan_bs) {

          //PILIH JENIS BARANG
          if ($jb == 1) {
            if (empty($nama_barang) || empty($id_jenis_barang)) {
              echo "<strong><p style='color: red; font-style: italic;'>Data tidak boleh kosong!</p></strong>";
            } else {

              $lihat = mysqli_fetch_assoc(
                mysqli_query(
                  $konek,
                  "SELECT * FROM code WHERE id_code = 1"
                )
              );
              $jumlah = $lihat['jumlah'] + 1;
              $id_code = $lihat['id_code'];
              $kode_barang = 'BR0' . $jumlah;

              $simpan_barang = mysqli_query(
                $konek,
                "INSERT INTO
              barang
              VALUES('$kode_barang',
              '$nama_barang',
              '$id_jenis_barang',
              '$id_bs',
              '',
              '',
              '',
              '$_SESSION[id_user]',
              '$riwayat')"
              );
              if ($simpan_barang) {
                $u_code = mysqli_query(
                  $konek,
                  "UPDATE code SET jumlah = '$jumlah' WHERE id_code = '$id_code'"
                );
                if ($u_code) {

                  // $nama_file_baru = uniqid();
                  // $nama_file_baru .= '.';
                  // $nama_file_baru .= $ekstensi_file;
                  // $pindah = move_uploaded_file($tmp_file, 'img/' . $nama_file_baru);

                  // if ($pindah) {
                  //   $simpan_gambar = mysqli_query(
                  //     $konek,
                  //     "INSERT INTO gambar_barang VALUES(null,'$kode_barang','$nama_file_baru')"
                  //   );
                  //   if ($simpan_gambar) {
                  echo "<h4 font-style: italic;'><span class='label label-success'>Simpan Berhasil</span></h4>";
                  // } else {
                  //   echo "<strong><p style='color: red; font-style: italic;'>Simpan gambar gagal<br>" . mysqli_error($konek) . '</p></strong>';
                  // }
                  // } else {
                  //   echo "<strong><p style='color: red; font-style: italic;'>Gambar gagal dipindah<br>" . mysqli_error($konek) . '</p></strong>';
                  // }
                } else {
                  echo "<strong><p style='color: red; font-style: italic;'>Update kode gagal<br>" . mysqli_error($konek) . '</p></strong>';
                }
              } else {
                echo "<strong><p style='color: red; font-style: italic;'>Simpan barang gagal<br>" . mysqli_error($konek) . '</p></strong>';
              }
            }
            //echo "Jenis barang dipilih";
          }
          //CREATE JENIS BARANG
          else {
            if (empty($nama_jenis_barang) || empty($nama_barang)) {
              echo "<strong><p style='color: red; font-style: italic;'>Data tidak boleh kosong!</p></strong>";
            } else {
              $simpan_jenis_barang = mysqli_query(
                $konek,
                "INSERT INTO jenis_barang VALUES(null,'$nama_jenis_barang')"
              );
              $id_jb = mysqli_insert_id($konek);
              if ($simpan_jenis_barang) {
                $lihat = mysqli_fetch_assoc(
                  mysqli_query(
                    $konek,
                    "SELECT * FROM code WHERE id_code = 1"
                  )
                );
                $jumlah = $lihat['jumlah'] + 1;
                $id_code = $lihat['id_code'];
                $kode_barang = 'BR0' . $jumlah;
                $simpan_barang = mysqli_query(
                  $konek,
                  "INSERT INTO
                barang
                VALUES('$kode_barang',
                '$nama_barang',
                '$id_jb',
                '$id_bs',
                '',
                '',
                '',
                '$_SESSION[id_user]',
                '$riwayat')"
                );
                if ($simpan_barang) {
                  $u_code = mysqli_query(
                    $konek,
                    "UPDATE code SET jumlah = '$jumlah' WHERE id_code = '$id_code'"
                  );
                  if ($u_code) {

                    // $nama_file_baru = uniqid();
                    // $nama_file_baru .= '.';
                    // $nama_file_baru .= $ekstensi_file;
                    // $pindah = move_uploaded_file($tmp_file, 'img/' . $nama_file_baru);

                    //                  if ($pindah) {
                    // $simpan_gambar = mysqli_query(
                    //   $konek,
                    //   "INSERT INTO gambar_barang VALUES(null,'$kode_barang','$nama_file_baru')"
                    // );
                    // if ($simpan_gambar) {
                    echo "<h4 font-style: italic;'><span class='label label-success'>Simpan Berhasil</span></h4>";
                    // } else {
                    //   echo "<strong><p style='color: red; font-style: italic;'>Simpan gambar gagal<br>" . mysqli_error($konek) . '</p></strong>';
                    // }
                    // } else {
                    //   echo "<strong><p style='color: red; font-style: italic;'>Gambar gagal dipindah<br>" . mysqli_error($konek) . '</p></strong>';
                    // }
                  } else {
                    echo "<strong><p style='color: red; font-style: italic;'>Simpan gagal<br>" . mysqli_error($konek) . '</p></strong>';
                  }
                } else {
                  echo "<strong><p style='color: red; font-style: italic;'>Simpan barang gagal<br>" . mysqli_error($konek) . '</p></strong>';
                }
              } else {
                echo "<strong><p style='color: red; font-style: italic;'>Simpan jenis barang gagal<br>!" . mysqli_error($konek) . '</p></strong>';
              }
            }
          } //tanda

        } else {
          echo "<h4><span class='label label-danger'>Nama Bentuk Sediaan sudah terdaftar sebelumnya!</h4></span>";
        }
      }
    }
    // }
  } elseif (isset($_POST['eMasterBarang'])) {
    $kode_barang = $_POST['kode_barang'];
    $nama_barang = htmlspecialchars($_POST['nama_barang']);
    $id_jenis_barang = $_POST['id_jenis_barang'];

    $id_bentuk_sediaan = $_POST['id_bentuk_sediaan'];

    $bs_baru = strtoupper(htmlspecialchars($_POST['bs_baru']));

    if (empty($kode_barang)) {
      echo "<h4><span class='label label-danger'>Kode barang tidak boleh kosong!</h4></span>";
    } elseif (empty($nama_barang)) {
      echo "<h4><span class='label label-danger'>Nama Barang tidak boleh kosong!</h4></span>";
    } elseif (empty($id_jenis_barang)) {
      echo "<h4><span class='label label-danger'>Jenis DIPA Harus dipilih!</h4></span>";
    } else {
      if (empty($bs_baru)) {
        $edit = mysqli_query(
          $konek,
          "UPDATE barang SET nama_barang = '$nama_barang',
        id_jenis_barang = '$id_jenis_barang',
        id_bentuk_sediaan = '$id_bentuk_sediaan',
        id_user = '$_SESSION[id_user]',
        riwayat_barang = '$riwayat'
        WHERE
        kode_barang = '$kode_barang'"
        );
        if ($edit) {
          echo "<script>
        alert('Barang berhasil diedit');
        location='?halaman=master barang';
        </script>";
        } else {
          echo "<h4><span class='label label-danger'>Barang gagal diedit!</h4></span>";
        }
      } else {
        $simpan_bs = mysqli_query(
          $konek,
          "INSERT INTO bentuk_sediaan VALUES(null,
        '$bs_baru')"
        );
        $id = mysqli_insert_id($konek);
        if ($simpan_bs) {
          $edit = mysqli_query(
            $konek,
            "UPDATE barang SET nama_barang = '$nama_barang',
        id_jenis_barang = '$id_jenis_barang',
        id_bentuk_sediaan = '$id',
        id_user = '$_SESSION[id_user]',
        riwayat_barang = '$riwayat'
        WHERE
        kode_barang = '$kode_barang'"
          );
          if ($edit) {
            echo "<script>
        alert('Barang berhasil diedit');
        location='?halaman=master barang';
        </script>";
          } else {
            echo "<h4><span class='label label-danger'>Barang gagal diedit!</h4></span>";
          }
        } else {
          echo "<h4><span class='label label-danger'>Simpan bentuk sediaan gagal!</h4></span>";
        }
      }
    }
  } elseif (isset($_GET['hapus-barang'])) {
    $id = $_GET['hapus-barang'];
    if (empty($id)) {
      echo "<script>location='?halaman=master barang';</script>";
    } else {
      $hapus_barang = mysqli_query($konek, "DELETE FROM barang WHERE kode_barang = '$id'");
      if ($hapus_barang) {
        $lihat = mysqli_fetch_assoc(mysqli_query($konek, "SELECT * FROM gambar_barang WHERE kode_barang = '$id'"));
        unlink('img/' . $lihat['nama_gambar']);
        $hapus_gambar = mysqli_query($konek, "DELETE FROM gambar_barang WHERE kode_barang = '$id'");
        if ($hapus_gambar) {
          echo "<script>alert('Hapus master barang berhasil'); location='?halaman=master barang';</script>";
        } else {
          echo "<strong><p style='color: red; font-style: italic;'>Hapus gambar barang gagal!<br>
        Barang sudah pernah dipakai sebelumnya!;
        </p></strong><br><a href='?halaman=master barang'>Kembali</a>";
        }
      } else {
        //      echo "<strong><p style='color: red; font-style: italic;'>Hapus barang gagal!<br>" . mysqli_error($konek) . "</p></strong><br><a href='?halaman=master barang'>Kembali</a>";
        echo "<strong><p style='color: red; font-style: italic;'>Hapus gambar barang gagal!<br>
        Barang sudah pernah dipakai sebelumnya!
        </p></strong><br><a href='?halaman=master barang'>Kembali</a>";
      }
    }
  } elseif (isset($_POST['sJenisBarang'])) {
    $nama_jenis_barang = htmlspecialchars($_POST['nama_jenis_barang']);
    if (empty($nama_jenis_barang)) {
      echo "<strong><p style='color: red; font-style: italic;'>Nama jenis barang masih kosong!</p></strong>";
    } else {
      $simpan = mysqli_query($konek, "INSERT INTO jenis_barang VALUES(null,'$nama_jenis_barang')");
      if ($simpan) {
        echo "<strong><p style='color: green; font-style: italic;'>Jenis barang berhasil ditambahkanl!";
      } else {
        echo "<strong><p style='color: red; font-style: italic;'>Jenis barang gagal disimpan!<br>" . mysqli_error($konek);
      }
    }
  } elseif (isset($_POST['ejenisBarang'])) {
    $id = $_POST['id'];
    if (empty($id)) {
      echo "<script>location='?halaman=jenis barang';</script>";
    } else {
      $nama_jenis_barang = htmlspecialchars($_POST['nama_jenis_barang']);
      if (empty($nama_jenis_barang)) {
        echo "<strong><p style='color: red; font-style: italic;'>Nama jenis barang tidak boleh kosong!";
      } else {
        $edit = mysqli_query(
          $konek,
          "UPDATE jenis_barang
        SET
        nama_jenis_barang = '$nama_jenis_barang'
        WHERE
        id_jenis_barang = '$id'"
        );
        if ($edit) {
          echo "<script>alert('Edit jenis barang berhasil');location='?halaman=jenis barang';</script>";
        } else {
          echo "<strong><p style='color: red; font-style: italic;'>Edit Jenis barang gagal!<br>" . mysqli_error($konek);
        }
      }
    }
  } elseif (isset($_GET['hapus-jenis-barang'])) {
    $id = mysqli_real_escape_string($konek, $_GET['hapus-jenis-barang']);
    if (empty($id)) {
      echo "<script>location='?halaman=jenis barang';</script>";
    } else {
      $hapus = mysqli_query(
        $konek,
        "DELETE FROM jenis_barang WHERE id_jenis_barang = '$id'"
      );
      if ($hapus) {
        echo "<script>alert('Hapus jenis barang berhasil');location='?halaman=jenis barang';</script>";
      } else {
        echo "<strong><p style='color: red; font-style: italic;'>Hapus jenis barang gagal!</p></strong><h4><span class='label label-warning'>Jenis barang dengan ID: $id telah dipakai sebelumnya pada Menu Master Barang</span></h4><a href='?halaman=master barang'>Check disini</a>";
      }
    }
  } elseif (isset($_POST['tUser'])) {
    $username = strtolower(htmlspecialchars($_POST['username']));
    $nama_lengkap = htmlspecialchars($_POST['nama_lengkap']);
    $id_level = $_POST['id_level'];
    $kode_jabatan = $_POST['kode_jabatan'];
    $jb = $_POST['jb'];
    $nama_jabatan = $_POST['nama_jabatan'];
    $pw1 = mysqli_real_escape_string($konek, $_POST['pw1']);
    $pw2 = mysqli_real_escape_string($konek, $_POST['pw2']);

    $akses_dipa = $_POST['akses_dipa'];

    if ($id_level == 3 and $akses_dipa == 1) {
      echo "<h4><span class='label label-danger'>Level user tidak dapat memilih semua pada akses Dipa!</h4></span>";
    } else {

      if (
        empty($username) ||
        empty($nama_lengkap) ||
        empty($pw1)
      ) {
        echo "<h4><span class='label label-danger'>Data tidak boleh ada yang kosong!</h4></span>";
      } elseif ($pw1 !== $pw2) {
        echo "<h4><span class='label label-danger'>Konfirmasi Password tidak sesuai!</h4></span>";
      } elseif (strlen($pw1) < 5) {
        echo "<h4><span class='label label-danger'>Password terlalu pendek!</h4></span>";
      } else {

        $password_baru = password_hash($pw1, PASSWORD_DEFAULT);

        if ($jb == 1) {
          if (empty($kode_jabatan)) {
            echo "<h4><span class='label label-danger'>Jabatan belum ada datanya!</h4></span>";
          } else {
            $simpan = mysqli_query(
              $konek,
              "INSERT INTO user VALUES(null,
        '$username',
        '$nama_lengkap',
        '$password_baru',
        '$id_level',
        '$kode_jabatan',
        '$riwayat',
        '',
        '1',
        'nophoto.png',
        '$akses_dipa')"
            );
            if ($simpan) {
              echo "<h4><span class='label label-success'>User berhasil didaftarkan!</h4></span>";
            } else {
              echo "<h4><span class='label label-danger'>Username $username sudah terdaftar sebelumnya!</h4></span>";
            }
          }
        } else {
          if (empty($nama_jabatan)) {
            echo "<h4><span class='label label-danger'>Nama Jabatan Masih Kosong!</h4></span>
        <span class='label label-warning'>Jika anda memilih Create a page and save it, anda harus mengisi kolom Nama Jabatan</span>";
          } else {
            $code = mysqli_fetch_assoc(mysqli_query($konek, "SELECT * FROM code WHERE id_code = 5"));
            $jumlah = $code['jumlah'] + 1;
            $kode_jabatan_baru = "JB0" . $jumlah;

            $simpan_jab = mysqli_query(
              $konek,
              "INSERT INTO jabatan VALUES('$kode_jabatan_baru','$nama_jabatan')"
            );
            if ($simpan_jab) {
              mysqli_query($konek, "UPDATE code SET jumlah = $jumlah WHERE id_code = 5");
              $simpan_user = mysqli_query(
                $konek,
                "INSERT INTO user VALUES(null,
            '$username',
            '$nama_lengkap',
            '$password_baru',
            '$id_level',
            '$kode_jabatan_baru',
            '$riwayat',
            '',
            '1',
        'nophoto.png',
        '$akses_dipa')"
              );
              if ($simpan_user) {
                echo "<h4><span class='label label-success'>User Berhasil didaftarkan!</h4></span>";
              } else {
                echo "<h4><span class='label label-danger'>Username $username sudah terdaftar sebelumnya!</h4></span>";
              }
            } else {
              echo "<h4><span class='label label-danger'>Nama jabatan $nama_jabatan sudah terdaftar sebelumnya!</h4></span>";
              //echo mysqli_error($konek);
            }
          }
        }
      }
    }
  } elseif (isset($_POST['sJabatan'])) {
    $jab = htmlspecialchars($_POST['jab']);
    $co = mysqli_fetch_assoc(mysqli_query($konek, "SELECT * FROM code WHERE id_code = 5"));
    $id_code = $co['id_code'];
    $jumlah = $co['jumlah'];
    $kode_jabatan = $jumlah + 1;
    $kode_jabatan_baru = 'JB0' . $kode_jabatan;
    if (empty($jab)) {
      echo "<h4><span class='label label-success'>Jabatan tidak boleh kosong!</h4></span>";
    } else {
      $simpan = mysqli_query(
        $konek,
        "INSERT INTO jabatan VALUES('$kode_jabatan_baru','$jab')"
      );
      if ($simpan) {
        $u_code = mysqli_query(
          $konek,
          "UPDATE code SET jumlah='$kode_jabatan' WHERE id_code = 5"
        );
        if ($u_code) {
          echo "<h4><span class='label label-success'>Jabatan Berhasil ditambahkan!</h4></span>";
        } else {
          echo "<h4><span class='label label-danger'>Edit code jabatan gagal!</h4></span><br>" . mysqli_error($konek);
        }
      } else {
        echo "<h4><span class='label label-danger'>Kode Jabatan sudah ada sebelumnya!</h4></span>";
      }
    }
  } elseif (isset($_POST['eJabatan'])) {
    $kode_jabatan = $_POST['kode_jabatan'];
    $nama_jabatan = htmlspecialchars($_POST['nama_jabatan']);
    if (empty($kode_jabatan)) {
      echo "<script>location='?halaman=jabatan';</script>";
    } elseif (empty($nama_jabatan)) {
      echo "<h4><span class='label label-danger'>Nama Jabatan tidak boleh kosong!</h4></span>";
    } else {
      $edit = mysqli_query(
        $konek,
        "UPDATE jabatan SET nama_jabatan = '$nama_jabatan' WHERE kode_jabatan = '$kode_jabatan'"
      );
      if ($edit) {
        echo "<script>alert('Edit jabatan berhasil'); location='?halaman=jabatan';</script>";
      } else {
        echo "<h4><span class='label label-danger'>Edit Jabatan Mengalami Kegagalan!</h4></span>";
      }
    }
  } elseif (isset($_GET['hapus-jabatan'])) {
    $id = mysqli_real_escape_string($konek, $_GET['hapus-jabatan']);
    if (empty($id)) {
      echo "<script>location='?halaman=jabatan';</script>";
    } else {
      $hapus = mysqli_query(
        $konek,
        "DELETE FROM jabatan WHERE kode_jabatan = '$id'"
      );
      if ($hapus) {
        echo "<script>alert('Hapus jabatan berhasil'); location='?halaman=jabatan';</script>";
      } else {
        echo "<strong><p style='color: red; font-style: italic;'>Hapus Jabatan gagal!</p></strong><h4><span class='label label-warning'>Jabatan dengan KODE JABATAN: $id telah dipakai sebelumnya pada Menu User</span></h4><a href='?halaman=user'>Check disini</a>";
      }
    }
  } elseif (isset($_POST['sbentukSediaan'])) {
    $nama_sediaan = strtoupper(htmlspecialchars($_POST['nama_sediaan']));
    if (empty($nama_sediaan)) {
      echo "<h4><span class='label label-danger'>Nama Bentuk Sediaan Tidak Boleh Kosong!</h4></span>";
    } else {
      $simpan = mysqli_query(
        $konek,
        "INSERT INTO bentuk_sediaan VALUES(null,'$nama_sediaan')"
      );
      if ($simpan) {
        echo "<h4><span class='label label-success'>Bentuk Sediaan Berhasil Ditambahkan</h4></span>";
      } else {
        echo "<h4><span class='label label-danger'>Nama Bentuk Sediaan Sudah Ada Sebelumnya, Mohon di check kembali ya...!</h4></span>";
      }
    }
  } elseif (isset($_POST['eBentukSediaan'])) {
    $nama_sediaan = strtoupper(htmlspecialchars($_POST['nama_sediaan']));
    $id = $_POST['id'];
    if (empty($nama_sediaan)) {
      echo "<h4><span class='label label-danger'>Nama Bentuk Sediaan Tidak Boleh Kosong!</h4></span>";
    } else {
      $edit = mysqli_query(
        $konek,
        "UPDATE bentuk_sediaan SET nama_bentuk_sediaan='$nama_sediaan' WHERE id_bentuk_sediaan = '$id'"
      );
      if ($edit) {
        echo "<script>alert('Edit bentuk sediaan berhasil'); location='?halaman=bentuk sediaan';</script>";
      } else {
        echo "<h4><span class='label label-danger'>gagal melakukan edit bentuk sediaan!</span></h4>" . mysqli_error($konek);
      }
    }
  } elseif (isset($_GET['hapus-bentuk-sediaan'])) {
    $id = mysqli_real_escape_string($konek, $_GET['hapus-bentuk-sediaan']);
    if (empty($id)) {
      echo "<script>location='?halaman=bentuk sediaan';</script>";
    } else {
      $hapus = mysqli_query(
        $konek,
        "DELETE FROM bentuk_sediaan WHERE id_bentuk_sediaan = '$id'"
      );
      if ($hapus) {
        echo "<script>alert('Hapus bentuk sediaan berhasil'); location='?halaman=bentuk sediaan';</script>";
      } else {
        echo "<h4><span class='label label-danger'>Gagal hapus bentuk sediaan!</span></h4>";
        echo "<h5><span class='label label-warning'>Bentuk Sediaan tersebut telah dipakai sebelumnya pada Menu Master Barang!</span></h5><a href='?halaman=master barang'>Check disini</a>";
      }
    }
  } elseif (isset($_POST['sBarangMasuk'])) {
    $kode_barang = $_POST['kode_barang'];
    $jumlah = $_POST['jumlah'];
    //  $tgl = $_POST['tgl'] . ' ' . date('H:i:s');
    $ket = htmlspecialchars($_POST['ket']);

    $brg = mysqli_fetch_assoc(mysqli_query($konek, "SELECT * FROM barang WHERE kode_barang = '$kode_barang'"));
    $tStok = $brg['total_stok'] + $jumlah;
    $tMasuk = $brg['total_masuk'] + $jumlah;

    if (empty($jumlah)) {
      echo "<h4><span class='label label-danger'>Jumlah tidak boleh kosong!</span></h4>";
    } elseif (empty($ket)) {
      echo "<h4><span class='label label-danger'>Keterangan harus diisi!</span></h4>";
    } else {
      $code = mysqli_fetch_assoc(mysqli_query($konek, "SELECT * FROM code WHERE id_code = '2'"));
      $jumlah_code = $code['jumlah'] + 1;
      $kode_barang_masuk = "M0" . $jumlah_code;

      $simpan = mysqli_query(
        $konek,
        "INSERT INTO barang_masuk VALUES('$kode_barang_masuk',
      '$kode_barang',
      '$jumlah',
      '$ket',
      '$riwayat',
      '$_SESSION[id_user]')"
      );
      if ($simpan) {
        $e_code = mysqli_query(
          $konek,
          "UPDATE code SET jumlah='$jumlah_code' WHERE id_code = '2'"
        );
        if ($e_code) {
          mysqli_query($konek, "UPDATE barang SET total_masuk = '$tMasuk', total_stok='$tStok' WHERE kode_barang = '$kode_barang'");
          echo "<script>alert('Barang Masuk berhasil disimpan'); location='?halaman=barang masuk';</script>";
        } else {
          echo "<h4><span class='label label-danger'>Update code gagal!</span></h4>" . mysqli_error($konek);
        }
      } else {
        echo "<h4><span class='label label-danger'>Simpan Barang Masuk gagal!</span></h4>" . mysqli_error($konek);
      }
    }
  } elseif (isset($_POST['sBarangKeluar'])) {
    $kode_barang = $_POST['kode_barang'];
    $kode_barang2 = base64_encode($kode_barang);
    $jumlah = $_POST['jumlah'];
    $ket = htmlspecialchars($_POST['ket']);

    $co = mysqli_fetch_assoc(mysqli_query($konek, "SELECT * FROM code WHERE id_code = 4"));
    $code_baru = $co['jumlah'] + 1;
    $NoTransaksi = "K0" . $code_baru;

    $brg = mysqli_fetch_assoc(mysqli_query($konek, "SELECT * FROM barang WHERE kode_barang = '$kode_barang'"));
    $stok = $brg['total_stok'];
    $total_stok = $stok - $jumlah;
    $total_keluar = $brg['total_keluar'] + $jumlah;
    if ($jumlah > $stok) {
      echo "<h4><span class='label label-danger'>Maaf jumlah stok barang tidak mencukupi!</span></h4><a href='?barang-masuk=$kode_barang2'>Tambah barang disini</a>";
    } else {
      $simpan = mysqli_query(
        $konek,
        "INSERT INTO barang_keluar
      (NoTransaksi,tgl_pengajuan,user_mengajukan,kode_barang,jumlah_keluar,id_status,ket)
      VALUES
      ('$NoTransaksi',
      '$riwayat',
      '$_SESSION[id_user]',
      '$kode_barang',
      '$jumlah',
      '0',
      '$ket')"
      );
      if ($simpan) {
        $uStok = mysqli_query(
          $konek,
          "UPDATE barang SET 
        total_stok='$total_stok',
        total_keluar = '$total_keluar',
        riwayat_barang='$riwayat'
        WHERE
        kode_barang = '$kode_barang'"
        );
        if ($uStok) {
          $uCode = mysqli_query($konek, "UPDATE code SET jumlah = '$code_baru' WHERE id_code = 4");
          if ($uCode) {
            $sRiwayat = mysqli_query(
              $konek,
              "INSERT INTO riwayat_trans
            VALUES(null,
            '$NoTransaksi',
            '$riwayat',
            '$_SESSION[id_user]',
            '$ket',
            '0')"
            );
            if ($sRiwayat) {
              echo "<script>
          alert('Transaksi Barang Keluar Berhasil Diinput');
          location='?halaman=barang keluar';
          </script>";
            } else {
              echo mysqli_error($konek);
            }
          } else {
            echo "gagal update code<br>" . mysqli_error($konek);
          }
        } else {
          echo "gagal update barang<br>" . mysqli_error($konek);
        }
      } else {
        echo "gagal simpan barang keluar<br>" . mysqli_error($konek);
      }
    }
  } elseif (isset($_GET['setujui-permintaan'])) {
    $id = base64_decode($_GET['setujui-permintaan']);
    if (empty($id)) {
      echo "<script>
    location='?halaman=barang keluar';
    </script>";
    } else {
      $cek = mysqli_num_rows(
        mysqli_query(
          $konek,
          "SELECT * FROM barang_keluar WHERE NoTransaksi = '$id'"
        )
      );
      if ($cek > 0) {
        $ubah = mysqli_query(
          $konek,
          "UPDATE barang_keluar SET id_status = 1, tgl_respons = '$riwayat', user_respons = '$_SESSION[id_user]' WHERE NoTransaksi = '$id'"
        );
        if ($ubah) {
          echo "<script>
        alert('Transaksi Berhasil Disetujui');
      location='?halaman=barang keluar';
    </script>";
        } else {
          echo "<script>
      alert('Barang keluar gagal disetujui');
    location='?halaman=barang keluar';
    </script>";
        }
      } else {
        echo "<script>
      alert('Sorry bro, usaha anda sia-sia untuk meng hack situs ini');
    location='?halaman=barang keluar';
    </script>";
      }
    }
  } elseif (isset($_POST['sTolakTransaksi'])) {

    $ket = htmlspecialchars($_POST['ket']);
    $NoTransaksi = $_POST['NoTransaksi'];

    if (empty($ket)) {
      echo "<h4><span class='label label-danger'>Keterangan tidak boleh kosong!</span></h4>";
    } else {
      $ubah = mysqli_query(
        $konek,
        "UPDATE barang_keluar SET id_status = '3', user_respons = '$_SESSION[id_user]', ket_respons = '$ket',
      tgl_respons = '$riwayat'
      WHERE
      NoTransaksi = '$NoTransaksi'"
      );
      if ($ubah) {
        echo "<script>
      alert('Transaksi berhasil ditolak');
    location='?halaman=barang keluar';
    </script>";
        mysqli_query(
          $konek,
          "INSERT INTO riwayat_trans VALUES(null,
      '$NoTransaksi',
      '$riwayat',
      '$_SESSION[id_user]',
      '$ket',
      '3')"
        );
      } else {
        echo "<h4><span class='label label-danger'>Gagal ubah status transaksi!</span></h4>";
      }
    }
  } elseif (isset($_POST['sSetujuiTransaksi'])) {
    $ket = htmlspecialchars($_POST['ket']);
    $NoTransaksi = $_POST['NoTransaksi'];

    $ubah = mysqli_query(
      $konek,
      "UPDATE barang_keluar SET id_status = '1', user_respons = '$_SESSION[id_user]', ket_respons = '$ket',
      tgl_respons = '$riwayat'
      WHERE
      NoTransaksi = '$NoTransaksi'"
    );
    if ($ubah) {
      $sRiwayat = mysqli_query(
        $konek,
        "INSERT INTO riwayat_trans
        VALUES(null,
          '$NoTransaksi',
        '$riwayat',
        '$_SESSION[id_user]',
        '$ket',
        '1')"
      );
      if ($sRiwayat) {
        echo "<script>
      alert('Transaksi berhasil disetujui');
    location='?halaman=barang keluar';
    </script>";
      } else {
        echo mysqli_error($konek);
      }
    } else {
      echo "<h4><span class='label label-danger'>Gagal ubah status transaksi!</span></h4>";
    }
  } elseif (isset($_POST['sBatalTransaksi'])) {
    $ket = htmlspecialchars($_POST['ket']);
    $NoTransaksi = $_POST['NoTransaksi'];

    $br = mysqli_fetch_assoc(mysqli_query(
      $konek,
      "SELECT * FROM barang_keluar WHERE NoTransaksi = '$NoTransaksi'"
    ));

    $jumlah_keluar = $br['jumlah_keluar'];
    $kode_barang = $br['kode_barang'];


    $masterBarang = mysqli_fetch_assoc(
      mysqli_query(
        $konek,
        "SELECT * FROM barang WHERE kode_barang = '$kode_barang'"
      )
    );

    $stok_lama = $masterBarang['total_stok'];
    $stok_terkini = $stok_lama + $jumlah_keluar;
    $total_keluar = $masterBarang['total_keluar'] - $jumlah_keluar;

    if (empty($ket)) {
      echo "<h4><span class='label label-danger'>Keterangan tidak boleh kosong!</span></h4>";
    } else {
      $ubah = mysqli_query(
        $konek,
        "UPDATE barang_keluar SET id_status = '2', user_respons = '$_SESSION[id_user]', ket_respons = '$ket',
      tgl_respons = '$riwayat'
      WHERE
      NoTransaksi = '$NoTransaksi'"
      );
      if ($ubah) {

        $sRiwayat = mysqli_query(
          $konek,
          "INSERT INTO riwayat_trans
        VALUES(null,
        '$NoTransaksi',
        '$riwayat',
        '$_SESSION[id_user]',
        '$ket',
        '2')"
        );
        if ($sRiwayat) {
          $uStok = mysqli_query(
            $konek,
            "UPDATE barang SET total_stok = '$stok_terkini',
          total_keluar = '$total_keluar',
          riwayat_barang = '$riwayat'
          WHERE
          kode_barang = '$kode_barang'"
          );
          if ($uStok) {
            echo "<script>
      alert('Transaksi berhasil dibatalkan');
    location='?halaman=barang keluar';
    </script>";
          } else {
            echo mysqli_error($konek);
          }
        } else {
          echo mysqli_error($konek);
        }
      } else {
        echo "<h4><span class='label label-danger'>Gagal ubah status transaksi!</span></h4>";
      }
    }
  } elseif (isset($_POST['eBarangMasuk'])) {
    $jumlah = $_POST['jumlah'];
    $ket = htmlspecialchars($_POST['ket']);
    $id = $_POST['id'];

    $bs = mysqli_fetch_assoc(
      mysqli_query(
        $konek,
        "SELECT * FROM barang_masuk WHERE kode_barang_masuk = '$id'"
      )
    );

    $jumlah_lama = $bs['jumlah'];
    $kode_barang = $bs['kode_barang'];

    $b = mysqli_fetch_assoc(
      mysqli_query(
        $konek,
        "SELECT * FROM barang WHERE kode_barang = '$kode_barang'"
      )
    );

    $stok = $b['total_stok'] - $jumlah_lama + $jumlah;
    $tMasuk = $b['total_masuk'] - $jumlah_lama + $jumlah;

    if (empty($jumlah)) {
      echo "<h4><span class='label label-danger'>Jumlah tidak boleh kosong!</span></h4>";
    } elseif (empty($ket)) {
      echo "<h4><span class='label label-danger'>Keterangan tidak boleh kosong!</span></h4>";
    } else {
      $uStok = mysqli_query(
        $konek,
        "UPDATE barang
    SET
    total_masuk = '$tMasuk',
    total_stok = '$stok',
    riwayat_barang = '$riwayat'
    WHERE
    kode_barang = '$kode_barang'"
      );
      if ($uStok) {
        $eBM = mysqli_query(
          $konek,
          "UPDATE barang_masuk
        SET
        jumlah = '$jumlah',
        ket = '$ket'
        WHERE
        kode_barang_masuk = '$id'"
        );
        if ($eBM) {
          echo "<script>
      alert('Barang Masuk dengan Kode $id Berhasil diedit');
    location='?halaman=barang masuk';
    </script>";
        } else {
          echo "<h4><span class='label label-danger'>Update barang masuk gagal!</span></h4>" . mysqli_error($konek);
        }
      } else {
        echo "<h4><span class='label label-danger'>Update stok gagal!</span></h4>" . mysqli_error($konek);
      }
    }
  } elseif (isset($_POST['sTransaksiBarangMasuk'])) {
    $id_jenis_barang = $_POST['id_jenis_barang'];
    $ket = htmlspecialchars($_POST['ket']);

    if (empty($id_jenis_barang)) {
      echo "<h4><span class='label label-danger'>Jenis DIPA harus dipilih terlebih dahulu</span></h4>";
    } else {

      $kode = mysqli_fetch_assoc(
        mysqli_query(
          $konek,
          "SELECT * FROM code WHERE id_code = 2"
        )
      );
      $jumlah = $kode['jumlah'] + 1;
      $kode_barang_masuk = 'M0' . $jumlah;
      $kode_barang_masuk2 = base64_encode($kode_barang_masuk);

      $s = mysqli_query(
        $konek,
        "INSERT INTO barang_masuk VALUES('$kode_barang_masuk',
      '$ket',
      '$riwayat',
      '$_SESSION[id_user]',
      '$id_jenis_barang')"
      );
      if ($s) {
        echo "<script>
      location='?barang-masuk-detail=$kode_barang_masuk2';
      </script>";
        mysqli_query(
          $konek,
          "UPDATE code SET jumlah = '$jumlah' WHERE id_code = 2"
        );
      } else {
        echo "gagal<br>" . mysqli_error($konek);
      }
    }
  } elseif (isset($_POST['sTransaksiBarangBaru'])) {
    $kode_barang = $_POST['kode_barang'];
    $qty = $_POST['qty'];
    $kode_barang_masuk = $_POST['kode_barang_masuk'];

    if (empty($kode_barang)) {
      echo "<h4><span class='label label-warning'>Kode barang harus dipilih terlebih dahulu!</span></h4>";
    } elseif (empty($qty)) {
      echo "<h4><span class='label label-warning'>Qty harus diisi!</span></h4>";
    } else {

      $stok = mysqli_fetch_assoc(
        mysqli_query(
          $konek,
          "SELECT * FROM barang WHERE kode_barang = '$kode_barang'"
        )
      );
      $stok_lama = $stok['total_stok'];
      $stok_baru = $stok_lama + $qty;
      $total_masuk = $stok['total_masuk'] + $qty;
      // if ($qty > $stok_lama) {
      //   echo "<h4><span class='label label-warning'>Jumlah STOK tidak mencukupi</span></h4>";
      // } else {
      $cek =
        mysqli_num_rows(
          mysqli_query(
            $konek,
            "SELECT * FROM transaksi
        WHERE
        NoTransaksi = '$kode_barang_masuk' AND
        tipe_transaksi = 1 AND
        kode_barang = '$kode_barang'"
          )
        );
      if ($cek > 0) {
        echo "<h4><span class='label label-danger'>Barang sudah ada sebelumnya!</span></h4>";
      } else {
        $simpan = mysqli_query(
          $konek,
          "INSERT INTO transaksi VALUES(null,
          '$kode_barang_masuk',
          '$qty',
          '1',
          '$kode_barang')"
        );
        if ($simpan) {
          mysqli_query(
            $konek,
            "UPDATE barang SET total_stok = '$stok_baru',
            total_masuk = '$total_masuk',
            riwayat_barang = '$riwayat'
            WHERE
            kode_barang = '$kode_barang'"
          );
          echo "<h4><span class='label label-success'>Simpan berhasil</span></h4>";
        } else {
          echo "<h4><span class='label label-danger'>Simpan gagal!</span></h4>" . mysqli_error($konek);
        }
      }
      // }
    }
  } elseif (isset($_POST['eBarangMasukDetail'])) {
    $qty = htmlspecialchars($_POST['qty']);
    $id = $_POST['id'];

    $cek = mysqli_fetch_assoc(
      mysqli_query(
        $konek,
        "SELECT * FROM
      transaksi,
      barang
      WHERE
      transaksi.id_transaksi = '$id' AND
      barang.kode_barang = transaksi.kode_barang"
      )
    );
    $stok = $cek['total_stok'] - $cek['qty'] + $qty;
    $tot_keluar = $cek['total_keluar'] - $cek['qty'] + $qty;
    $kode_barang_masuk = base64_encode($cek['NoTransaksi']);

    $edit = mysqli_query(
      $konek,
      "UPDATE transaksi SET qty = '$qty' WHERE id_transaksi = '$id'"
    );
    if ($edit) {
      echo "<script>
    location='?barang-masuk-detail=$kode_barang_masuk';
    </script>";
      mysqli_query(
        $konek,
        "UPDATE barang SET total_stok = '$stok',
      total_keluar = '$tot_keluar',
      riwayat_barang = '$riwayat'
      WHERE
      kode_barang = '$cek[kode_barang]'"
      );
    } else {
      echo "<h4><span class='label label-danger'>Edit gagal!</span></h4>" . mysqli_error($konek);
    }
  } elseif (isset($_GET['hapus-barang-masuk-detail'])) {
    $id = $_GET['hapus-barang-masuk-detail'];
    $cek = mysqli_fetch_assoc(
      mysqli_query(
        $konek,
        "SELECT * FROM
      transaksi,
      barang
      WHERE
      transaksi.id_transaksi = '$id' AND
      barang.kode_barang = transaksi.kode_barang"
      )
    );
    $stok = $cek['total_stok'] - $cek['qty'];
    $tot_keluar = $cek['total_keluar'] - $cek['qty'];
    $kode_barang_masuk = base64_encode($cek['NoTransaksi']);

    if (empty($id)) {
      echo "<script>
    location='?halaman=barang masuk';
    </script>";
    } else {
      $hapus = mysqli_query(
        $konek,
        "DELETE FROM transaksi WHERE id_transaksi = '$id'"
      );
      if ($hapus) {
        mysqli_query(
          $konek,
          "UPDATE barang SET total_stok = '$stok',
        total_keluar = '$tot_keluar',
        riwayat_barang = '$riwayat' 
        WHERE
        kode_barang = '$cek[kode_barang]'"
        );
        echo "<script>
      location='?barang-masuk-detail=$kode_barang_masuk'
      </script>";
      } else {
        mysqli_error($konek);
      }
    }
  } elseif (isset($_POST['sPengajuan'])) {
    $id_jenis_barang = $_POST['id_jenis_barang'];
    $ket = htmlspecialchars($_POST['ket']);

    if (empty($id_jenis_barang)) {
      echo "<h4><span class='label label-warning'>Jenis DIPA Harus dipilih terlebih dahulu!</span></h4>";
    } elseif (empty($ket)) {
      echo "<h4><span class='label label-warning'>Keterangan tidak boleh kosong!</span></h4>";
    } else {
      $kode = mysqli_fetch_assoc(
        mysqli_query(
          $konek,
          "SELECT * FROM code WHERE id_code = 4"
        )
      );
      $jumlah_baru = $kode['jumlah'] + 1;
      $NoTransaksi = 'K0' . $jumlah_baru;
      $NoTransaksi2 = base64_encode($NoTransaksi);

      $simpan = mysqli_query(
        $konek,
        "INSERT INTO barang_keluar VALUES('$NoTransaksi',
      '$riwayat',
      '$_SESSION[id_user]',
      '',
      '',
      '',
      '4',
      '$ket',
      '$id_jenis_barang')"
      );
      if ($simpan) {
        echo "<script>
      location='?detail-barang-keluar=$NoTransaksi2';
      </script>";
        mysqli_query(
          $konek,
          "UPDATE code SET jumlah = '$jumlah_baru' WHERE id_code = 4"
        );
        mysqli_query(
          $konek,
          "INSERT INTO riwayat_trans VALUES(null,
        '$NoTransaksi',
        '$riwayat',
        '$_SESSION[id_user]',
        '$ket',
        '4')"
        );
      } else {
        echo mysqli_error($konek);
      }
    }
  } elseif (isset($_POST['sTransaksiBarangKeluar'])) {
    $kode_barang = $_POST['kode_barang'];
    $qty = $_POST['qty'];
    $NoTransaksi = $_POST['NoTransaksi'];

    $st = mysqli_fetch_assoc(
      mysqli_query(
        $konek,
        "SELECT * FROM barang WHERE kode_barang = '$kode_barang'"
      )
    );

    $stok_lama = $st['total_stok'];
    $stok_baru = $stok_lama - $qty;
    $tot_keluar = $st['total_keluar'] - $qty;

    if ($qty > $stok_lama) {
      echo "<h4><span class='label label-warning'>Stok barang tidak mencukupi!</span></h4>";
    } else {
      $cek = mysqli_num_rows(
        mysqli_query(
          $konek,
          "SELECT * FROM transaksi WHERE
        kode_barang = '$kode_barang' AND
        NoTransaksi = '$NoTransaksi' AND
        tipe_transaksi = 2"
        )
      );
      if ($cek > 0) {
        echo "<h4><span class='label label-warning'>Data sudah ada sebelumnya!</span></h4>";
      } else {
        $simpan = mysqli_query(
          $konek,
          "INSERT INTO transaksi VALUES(null,
        '$NoTransaksi',
        '$qty',
        '2',
        '$kode_barang')"
        );
        if ($simpan) {
          echo "<h4><span class='label label-success'>Barang berhasil ditambah</span></h4>";
          mysqli_query(
            $konek,
            "UPDATE barang SET total_stok = '$stok_baru',
          total_keluar = '$tot_keluar',
          riwayat_barang = '$riwayat'
          WHERE
          kode_barang = '$kode_barang'"
          );
        } else {
          echo mysqli_error($konek);
        }
      }
    }
  } elseif (isset($_POST['eBarangKeluarDetail'])) {
    $qty = $_POST['qty'];
    $id = $_POST['id'];

    $lih = mysqli_fetch_assoc(
      mysqli_query(
        $konek,
        "SELECT * FROM transaksi WHERE id_transaksi = '$id'"
      )
    );
    $kode_barang = $lih['kode_barang'];
    $NoTransaksi = base64_encode($lih['NoTransaksi']);

    $brg = mysqli_fetch_assoc(
      mysqli_query(
        $konek,
        "SELECT * FROM barang WHERE kode_barang = '$kode_barang'"
      )
    );
    $stok_lama = $brg['total_stok'];
    $stok_baru = $stok_lama + $lih['qty'] - $qty;
    $tot_keluar = $stok_lama + $lih['qty'] - $qty;

    if ($qty > $stok_lama) {
      echo "<h4><span class='label label-warning'>Stok barang tidak cukup!</span></h4>";
    } else {
      $edit = mysqli_query(
        $konek,
        "UPDATE transaksi SET qty = '$qty' WHERE id_transaksi = '$id'"
      );
      if ($edit) {
        echo "<script>
      location='?detail-barang-keluar=$NoTransaksi';
      </script>";
        mysqli_query(
          $konek,
          "UPDATE barang
        SET
        total_stok = '$stok_baru',
        total_keluar = '$tot_keluar',
        riwayat_barang = '$riwayat'
        WHERE
        kode_barang = '$kode_barang'"
        );
      } else {
        echo mysqli_error($konek);
      }
    }
  } elseif (isset($_GET['hapus-barang-keluar-detail'])) {
    $id = $_GET['hapus-barang-keluar-detail'];

    $cek = mysqli_fetch_assoc(
      mysqli_query(
        $konek,
        "SELECT * FROM
      transaksi,
      barang
      WHERE
      transaksi.id_transaksi = '$id' AND
      barang.kode_barang = transaksi.kode_barang"
      )
    );

    $stok = $cek['total_stok'] + $cek['qty'];
    $tot_keluar = $cek['total_keluar'] + $cek['qty'];
    $NoTransaksi = base64_encode($cek['NoTransaksi']);

    if (empty($id)) {
      echo "<script>
    location='?halaman=barang keluar';
    </script>";
    } else {
      $hapus = mysqli_query(
        $konek,
        "DELETE FROM transaksi WHERE id_transaksi = '$id'"
      );
      if ($hapus) {
        mysqli_query(
          $konek,
          "UPDATE barang SET total_stok = '$stok',
        total_keluar = '$tot_keluar',
        riwayat_barang = '$riwayat'
        WHERE
        kode_barang = '$cek[kode_barang]'"
        );
        echo "<script>
      location='?detail-barang-keluar=$NoTransaksi';
      </script>";
      } else {
        echo mysqli_error($konek);
      }
    }
  } elseif (isset($_GET['kirim-pengajuan'])) {
    $id = mysqli_real_escape_string($konek, $_GET['kirim-pengajuan']);
    if (empty($id)) {
      echo "<script>
    location='?halaman=barang keluar';
    </script>
    ";
    } else {
      $u = mysqli_query(
        $konek,
        "UPDATE barang_keluar SET id_status = 0 WHERE NoTransaksi = '$id'"
      );
      if ($u) {
        $riw = mysqli_query(
          $konek,
          "INSERT INTO riwayat_trans VALUES(null,
        '$id',
        '$riwayat',
        '$_SESSION[id_user]',
        '',
        '0')"
        );
        if ($riw) {
          echo "<script>
      alert('Pengajuan dengan No Transaksi: $id Berhasil Dikirim');
      location='?halaman=barang keluar';
      </script>";
        } else {
          mysqli_error($konek);
        }
      } else {
        echo mysqli_error($konek);
      }
    }
  } elseif (isset($_POST['uProfile'])) {
    $username = htmlspecialchars($_POST['username']);
    $nama_lengkap = htmlspecialchars($_POST['nama_lengkap']);
    $id_level = $_POST['id_level'];
    $kode_jabatan = $_POST['kode_jabatan'];
    $status_akun = $_POST['status_akun'];
    $akses_dipa = $_POST['akses_dipa'];

    @$check = $_POST['check'];

    $id_user = $_POST['id_user'];

    $nama_file = $_FILES['gambar']['name'];
    $tipe_file = $_FILES['gambar']['type'];
    $ukuran_file = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmp_file = $_FILES['gambar']['tmp_name'];

    $daftar_gambar = ['jpg', 'jpeg', 'png'];
    $ekstensi_file = explode('.', $nama_file);
    $ekstensi_file = strtolower(end($ekstensi_file));

    $cek_user = mysqli_fetch_assoc(
      mysqli_query(
        $konek,
        "SELECT * FROM user WHERE id_user = '$id_user'"
      )
    );

    if ($check == true) {
      if (!in_array($ekstensi_file, $daftar_gambar)) {
        echo "<h4><span class='label label-warning'>Yang anda pilih bukan gambar!</span></h4>";
      } elseif ($tipe_file != 'image/jpeg' && $tipe_file != 'image/png') {
        echo "<h4><span class='label label-warning'>Yang anda pilih bukan gambar!</span></h4>";
      } elseif ($ukuran_file > 5000000) {
        echo "<h4><span class='label label-warning'>Ukuran gambar terlalu besar!</span></h4>";
      } else {
        $nama_file_baru = uniqid();
        $nama_file_baru .= '.';
        $nama_file_baru .= $ekstensi_file;

        if ($cek_user['pp'] == 'nophoto.png') {
          if (empty($username) || empty($nama_lengkap) || empty($id_level) || empty($kode_jabatan) || empty($akses_dipa) || empty($status_akun)) {
            echo "<h4><span class='label label-warning'>Data tidak boleh kosong!</span></h4>";
          } else {
            $pindah = move_uploaded_file($tmp_file, '../../images/' . $nama_file_baru);
            if ($pindah) {
              $edit = mysqli_query(
                $konek,
                "UPDATE user SET username = '$username',
              nama_lengkap = '$nama_lengkap',
              id_level = '$id_level',
              kode_jabatan = '$kode_jabatan',
              status_akun = '$status_akun',
              pp = '$nama_file_baru',
              akses_dipa = '$akses_dipa'
              WHERE
              id_user = '$id_user'"
              );
            } else {
              echo "<h4><span class='label label-danger'>Gambar gagal dipindah!</span></h4>";
            }
          }
        } else {
          if (empty($username) || empty($nama_lengkap) || empty($id_level) || empty($kode_jabatan) || empty($akses_dipa) || empty($status_akun)) {
            echo "<h4><span class='label label-warning'>Data tidak boleh kosong!</span></h4>";
          } else {
            unlink('../../images/' . $cek_user['pp']);
            $pindah = move_uploaded_file($tmp_file, '../../images/' . $nama_file_baru);
            if ($pindah) {
              $edit = mysqli_query(
                $konek,
                "UPDATE user SET username = '$username',
              nama_lengkap = '$nama_lengkap',
              id_level = '$id_level',
              kode_jabatan = '$kode_jabatan',
              status_akun = '$status_akun',
              pp = '$nama_file_baru',
              akses_dipa = '$akses_dipa'
              WHERE
              id_user = '$id_user'"
              );
              if ($edit) {
                echo "<h4><span class='label label-success'>User berhasil di update!</span></h4>";
              } else {
                echo "<h4><span class='label label-danger'>Edit user gagal!</span></h4>";
              }
            } else {
              echo "<h4><span class='label label-danger'>Gambar gagal dipindah!</span></h4>";
            }
          }
        }
      }
    } else {
      if (empty($username) || empty($nama_lengkap) || empty($id_level) || empty($kode_jabatan) || empty($akses_dipa) || empty($status_akun)) {
        echo "<h4><span class='label label-warning'>Data tidak boleh kosong!</span></h4>";
      } else {
        $edit = mysqli_query(
          $konek,
          "UPDATE user SET username = '$username',
              nama_lengkap = '$nama_lengkap',
              id_level = '$id_level',
              kode_jabatan = '$kode_jabatan',
              status_akun = '$status_akun',
              akses_dipa = '$akses_dipa'
              WHERE
              id_user = '$id_user'"
        );
        if ($edit) {
          echo "<h4><span class='label label-success'>User berhasil di update!</span></h4>";
        } else {
          echo "<h4><span class='label label-danger'>Edit user gagal!</span></h4>";
        }
      }
    }
  } elseif (isset($_POST['uPassword'])) {
    $NewPassword = mysqli_real_escape_string($konek, $_POST['NewPassword']);
    $NewPasswordConfirm = mysqli_escape_string($konek, $_POST['NewPasswordConfirm']);

    $id_user = $_POST['id_user'];

    if (empty($NewPassword) || empty($NewPasswordConfirm)) {
      echo "<h4><span class='label label-warning'>Password tidak boleh kosong!</span></h4>";
    } else {
      if ($NewPassword !== $NewPasswordConfirm) {
        echo "<h4><span class='label label-warning'>Konfirmasi Password tidak sesuai!</span></h4>";
      } else {
        if (strlen($NewPassword) < 5) {
          echo "<h4><span class='label label-warning'>Password terlalu pendek, minimal 6 Karakter!</span></h4>";
        } else {
          $password_baru = password_hash($NewPassword, PASSWORD_DEFAULT);
          $upw = mysqli_query(
            $konek,
            "UPDATE user SET password = '$password_baru' WHERE id_user = '$id_user'"
          );
          if ($upw) {
            echo "<h4><span class='label label-success'>Password berhasil diubah!</span></h4>";
          } else {
            echo "<h4><span class='label label-danger'>Password gagal diubah!</span></h4>";
          }
        }
      }
    }
  } elseif (isset($_GET['hapus-user'])) {
    $id = mysqli_real_escape_string($konek, $_GET['hapus-user']);

    $cek = mysqli_fetch_assoc(
      mysqli_query(
        $konek,
        "SELECT * FROM user WHERE id_user = '$id'"
      )
    );
    $pp = $cek['pp'];

    if ($pp == 'nophoto.png') {
      $hapus = mysqli_query(
        $konek,
        "DELETE FROM user WHERE id_user = '$id'"
      );
      if ($hapus) {
        echo "<script>
      alert('User berhasil dihapus');
      location='?halaman=user';
      </script>";
      } else {
        echo "<script>
      alert('User gagal dihapus');
      location='?halaman=user';
      </script>";
      }
    } else {
      unlink('../../images/' . $pp);
      $hapus = mysqli_query(
        $konek,
        "DELETE FROM user WHERE id_user = '$id'"
      );
      if ($hapus) {
        echo "<script>
      alert('User berhasil dihapus');
      location='?halaman=user';
      </script>";
      } else {
        echo "<script>
      alert('User gagal dihapus');
      location='?halaman=user';
      </script>";
      }
    }
  }
}
