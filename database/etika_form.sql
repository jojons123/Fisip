-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2019 at 05:34 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `etika_form`
--

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `id` int(11) NOT NULL,
  `id_question` int(11) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `answer` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `base_mata_kuliah`
--

CREATE TABLE `base_mata_kuliah` (
  `id` int(11) NOT NULL,
  `mata_kuliah` varchar(255) NOT NULL,
  `sks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `base_mata_kuliah`
--

INSERT INTO `base_mata_kuliah` (`id`, `mata_kuliah`, `sks`) VALUES
(1, 'Filsafat Ilmu', 3),
(2, 'Metode Penelitian Kualitatif', 3),
(5, 'Metode Penelitian Kuantitatif', 3),
(6, 'Teori Administrasi, Organisasi, dan Manajamen', 3),
(7, 'Teori Politik dan Pembangunan', 3),
(8, 'Perumusan Kebijakan Publik', 3),
(9, 'Analisis Implementasi Kebijakan Publik', 3),
(10, 'Manajemen Publik', 3),
(11, 'Evaluasi Kebijakan Publik', 3),
(12, 'Pengembangan Wilayah', 3),
(13, 'Kebijakan dan Startegi Operasi', 3),
(14, 'Kebijakan dan Startegi Pemasaran', 3),
(15, 'Kebijakan dan Startegi Keuangan', 3),
(16, 'Kebijakan dan Startegi PSDM', 3),
(17, 'Manajemen Startegik dan Inovasi', 3),
(18, 'Reading Course', 3),
(19, 'Karya Ilmiah dan Publikasi', 3),
(20, 'Tesis', 9);

-- --------------------------------------------------------

--
-- Table structure for table `dosen_pembimbing`
--

CREATE TABLE `dosen_pembimbing` (
  `id` int(11) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nim` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `universitas` varchar(50) NOT NULL,
  `fakultas` varchar(50) NOT NULL,
  `program_studi` varchar(50) NOT NULL,
  `semester` varchar(5) NOT NULL,
  `nomer_handphone` varchar(15) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mata_kuliah`
--

CREATE TABLE `mata_kuliah` (
  `id` int(11) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `mata_kuliah` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `question` text NOT NULL,
  `placeholer` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `section` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  `prop` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `question`, `placeholer`, `type`, `slug`, `section`, `priority`, `prop`) VALUES
(2, 'Silahkan tulis deskripsi singkat terkait tujuan penelitian, bentuk proposal penelitian dan metode yang digunakan untuk mencapai tujuan tersebut. (maksimal 400 kata)', '', 'textarea', 'deskripsi_penelitian', 2, 1, NULL),
(3, 'Uraikan ringkasan kualifikasi dan keahlian yang relevan dengan penelitian', '', 'textarea', 'kualifikasi_keahlian', 3, 1, NULL),
(4, 'Uraikan bila terdapat conflict of interest dari topik penelitian anda', '', 'textarea', 'interest_penelitian', 3, 2, NULL),
(5, 'Dimanakah penelitian ini akan diselenggarakan?', '', 'text', 'tempat_penelitian', 3, 3, NULL),
(6, 'Jelaskan dan uraikan peran peneliti utama dalam proyek ini?', '', 'textarea', 'peran_peneliti_utama', 3, 4, NULL),
(7, '<b>Identitas Terakhir Pendidikan Mahasiswa </b>\r\n<br>\r\nUniversitas: ', '', 'text', 'universitas_putama', 3, 5, NULL),
(8, 'Fakultas', '', 'text', 'fakultas_putama', 3, 6, NULL),
(9, 'Gelar', '', 'text', 'gelar_putama', 3, 7, NULL),
(10, 'Konsentrasi', '', 'text', 'konsentrasi_putama', 3, 8, NULL),
(11, 'Apakah penelitian ini merupakan bagian dari penilaian studi mahasiswa?', '', 'radio', 'bagian_penilaian_studi', 3, 9, NULL),
(12, 'Apakah penelitian ini merupakan mata kuliah wajib?', '', 'radio', 'apakah_matakuliah_wajib', 3, 10, NULL),
(13, 'Silahkan paparkan di bawah, pelatihan atau pengalaman apa yang dimiliki mahasiswa dalam metodologi penelitian yang relevan?', '', 'textarea', 'pengalaman_mahasiswa', 3, 11, NULL),
(14, 'Silahkan paparkan di bawah, pelatihan apa yang telah diterima mahasiswa dalam etika penelitian? ', '', 'textarea', 'pelatihan_etika', 3, 12, NULL),
(15, '<b> Identitas Pembimbing Utama </b> <br>\r\nNama:', '', 'text', 'nama_pem_utama', 4, 2, NULL),
(16, 'Gelar', '', 'text', 'gelar_pemutama', 4, 3, NULL),
(17, 'Keahlian yang relevan', '', 'text', 'keahlian_pem_utama', 4, 4, NULL),
(18, '<b> Identitas Pembimbing Anggota 1 </b> <br>\r\nNama:', '', 'text', 'nama_pem_anggota1', 4, 5, NULL),
(19, 'Gelar', '', 'text', 'gelar_pem_anggota1', 4, 6, NULL),
(20, 'Keahlian yang relevan', '', 'text', 'keahlian_pem_anggota1', 4, 7, NULL),
(21, '<b> Identitas Pembimbing Anggota 2 </b> <br>\r\nNama:', '', 'text', 'nama_pem_anggota2', 4, 8, NULL),
(22, 'Gelar', '', 'text', 'gelar_pem_anggota2', 4, 9, NULL),
(23, 'Keahlian yang relevan', '', 'text', 'keahlian_pem_anggota2', 4, 10, NULL),
(24, '<b> Identitas Pembimbing Anggota 3 </b> <br>\r\nNama:', '', 'text', 'nama_pem_anggota3', 4, 11, NULL),
(25, 'Gelar', '', 'text', 'gelar_pem_anggota3', 4, 12, NULL),
(26, 'Keahlian yang relevan', '', 'text', 'keahlian_pem_anggota3', 4, 13, NULL),
(27, 'Berapa jumlah pembimbing dalam penelitian ini?\r\n', '', 'text', 'jumlah_pembimbing', 4, 1, NULL),
(28, 'Berapa jumlah asisten peneliti yang akan membantu anda dalam penelitian ini? \r\n', '', 'text', 'jumlah_asisten', 5, 1, NULL),
(36, 'Nama', '', 'text', 'Nama_asisten_pen', 5, 2, NULL),
(37, 'Alamat', '', 'text', 'alamat_asisten_pen', 4, 3, NULL),
(38, 'Universitas', '', 'text', 'universitas_asisten_pen', 5, 4, NULL),
(39, 'Posisi', '', 'text', 'posisi_asisten', 5, 5, NULL),
(40, 'Kontak', '', 'text', 'kontak_asisten', 5, 6, NULL),
(41, 'Email', '', 'text', 'Email_asisten_pen', 5, 7, NULL),
(43, 'Berapa jumlah pihak lain yang terlibat dalam penelitian ini?', '', 'text', 'jumlah_terlibat_penelitian', 6, 1, NULL),
(44, 'Apakah ada orang lain dengan peran-peran tertentu yang terlibat pada penelitian ini? (Contoh : analis data, notulen)', '', 'radio', 'peran_terlibat_penelitian', 6, 2, NULL),
(45, 'Apakah terdapat persyaratan sertifikasi, akreditasi dan kredensial yang  relevan dalam penelitian ini?', '', 'radio', 'persyaratan_sertifikas', 6, 3, NULL),
(46, 'Apakah peneliti atau pihak lain yang terlibat dalam penelitian ini  memerlukan  pelatihan tambahan?', '', 'radio', 'perlu_pelatihan_tambahan', 6, 4, NULL),
(48, 'Apakah Indonesia menjadi lokasi penelitian yang akan digunakan dalam penelitian ini?', '', 'radio', 'indonesia_penelitian', 10, 1, NULL),
(49, 'Jika Ya, Berapa banyak tempat penelitian di Indonesia yang akan digunakan dalam penelitian ini? Sebutkan nama atau lokasi tempat penelitian!', '', 'textarea', 'banyak_tempat_penelitian', 10, 2, NULL),
(50, 'Apakah lokasi di Luar Negeri yang akan diguanakan dalam penelitian?', '', 'radio', 'tempat_luarnegeri', 10, 3, NULL),
(51, 'Berapa banyak lokasi di Luar Negeri yang akan digunakan dalam penelitian? Sebutkan nama atau lokasi tempat penelitian!', '', 'textarea', 'banyak_tempat_luarnegeri', 10, 4, NULL),
(52, '<b> Tuliskan tanggal mulai dan tanggal selesai untuk seluruh penelitian (termasuk analisis data) </b> <br>\r\nTanggal mulai:	\r\n', '', 'text', 'tanggal_mulai_penelitian', 10, 5, NULL),
(53, 'Tanggal selesai:', '', 'text', 'tanggal_selesai_penelitian', 10, 6, NULL),
(54, 'Apakah terdapat aspek-aspek deadline studi/penelitian yang harus diketahui oleh Komisi Pembimbingan?', '', 'textarea', 'aspek_deadline', 10, 7, NULL),
(55, '<b> Penelitian yang dilakukan di Luar Negeri </b> <br> \r\nApakah terdapat persayaratan bagi peneliti asing (Anda) yang diperlukan untuk melakukan  penelitian ini di negara tujuan Anda? Jika iya, paparkan di bawah ini!\r\n', '', 'textarea', 'penelitian_luar_negeri', 10, 8, NULL),
(56, 'Apakah proposal penelitian anda (termasuk desain dan metodologi) sudah di review oleh teman sejawat? Jika iya, paparkan di bawah ini!', '', 'textarea', 'proposal_review', 10, 9, NULL),
(57, '<b> Pemohon/peneliti utama </b> <br>\r\n(uraikan kualifikasi pendidikan formal dan pelatihan yang relevan dengan penelitian)', '', 'textarea', 'kualifikasi_pendidikan', 13, 1, ''),
(58, 'Sebut dan jelaskan potensi conflict of interest yang mungkin terjadi dalam penelitian ini', '', 'textarea', 'potensi_conflict_interest', 13, 2, ''),
(59, '<b> 1. Jenis Penelitian </b> <br>\r\nSilahkan Tulis sebanyak mungkin informasi yang berasosiasi dengan penelitian anda dibawah ini <br>\r\n1. Penelitian dengan metodologi kualitatif <br>\r\n2. Penelitian dengan metodologi kuantitatif <br>\r\n3. Penelitian dengan metodologi campuran (mix methods) <br>\r\n4. Penelitian dengan melibatkan partisipan yang dilakukan di dalam negeri <br>\r\n5. Penelitian dengan melibatkan partisipan yang dilakukan di luar negeri<br>\r\n', '', 'textarea', 'asosiasi_penelitian', 14, 1, NULL),
(60, 'Apakah penelitian ini mengharuskan anonimitas terbatas terhadap individu atau kelompok masyarakat yang berada pada lokasi penelitian anda? ', '', 'radio', 'anonimitias_individu', 14, 2, NULL),
(61, 'Apakah peneliti memohon agar Komisi Pembimbingan untuk mengesampingkan persyaratan persetujuan dari individu atau kelompok masyarakat yang berada pada lokasi penelitian anda? ', '', 'radio', 'persetujuan_individu_lokasipen', 14, 3, NULL),
(62, '<b> 2. Rencana Penelitian </b>\r\n<br>\r\nSilahkan paparkan di bawah, dasar teoritis, empiris dan konseptual dan latar belakang dari proposal penelitian ini. Misal: studi sebelumnya, tinjauan literatur atau pengamatan sebelumnya (minimal 4000 karakter).', '', 'textarea', 'dasar_teoritis_penelitian', 14, 4, NULL),
(63, 'Sebutkan tujuan dan pertanyaan penelitian / hipotesis dari penelitian anda', '', 'textarea', 'tujuan_hipotesis_penelitian', 14, 5, NULL),
(64, 'Apakah penelitian ini pernah dilakukan sebelumnya?', '', 'radio', 'penelitian_sudahataubelum', 14, 6, NULL),
(65, '<b> 3. Manfaat/Resiko </b>\r\n<br>\r\nApakah penelitian ini melibatkan praktik atau intervensi sosial? ', '', 'radio', 'penelitian_praktik_intervensi', 14, 7, NULL),
(66, 'Manfaat apa yang akan berdampak pada masyarakat luas dari penelitian ini?', '', 'textarea', 'manfaat_impact_masyarakat', 14, 8, NULL),
(67, 'Manfaat apa yang berdampak pada partisipan dari penelitian ini?', '', 'textarea', 'manfaat_impact_partisipan', 14, 9, NULL),
(68, 'Apakah terdapat risiko bagi partisipan yang terlibat dalam penelitian ini?', '', 'radio', 'risiko_partisipan_penelitian', 14, 10, NULL),
(69, 'Jelaskan manfaat positif dari penelitian ini tanpa mengesampingkan resiko, ketidaknyamanan atau paparan terhadap bahaya yang mungkin diterima oleh para partisipan dalam penelitian ini', '', 'textarea', 'manfaat_positif_penelitian', 14, 11, NULL),
(70, 'Apakah terdapat risiko lain yang berdampak pada pihak yang terlibat dalam penelitian ini? (misal: kelompok penelitian, organisasi, dll) ', '', 'radio', 'risiko_pihak_penelitian', 14, 12, NULL),
(71, 'Apakah penelitian ini secara potensial akan menghasilkan keuntungan komersial bagi peneliti dan sponsor penelitian? ', '', 'radio', 'potensial_menghasilkan_komersial', 14, 13, NULL),
(72, 'Jika YA, jelaskan secara singkat potensi yang akan menghasilkan keuntungan komersial bagi peneliti dan sponsor penelitian!', '', 'textarea', 'potensi_menghasilkan_keuntungan', 14, 14, NULL),
(73, 'Apakah penyebarluasan hasil penelitian dapat menyebabkan kerugian dalam bentuk apapun terhadap individu para partisipan baik secara fisik, psikologi, spiritual,emosional, social atau finansial, atau terhadap kemampuan professional mereka atau komunitas mereka?', '', 'radio', 'penyebarluasan_hasil_penelitian', 14, 15, NULL),
(74, '<b> 4. Pemantauan </b> <br>\r\nMekanisme apa yang digunakan oleh peneliti untuk memantau peneliti dan kemajuan peneliti?', '', 'textarea', 'mekanisme_peneliti', 14, 16, NULL),
(75, '<b> 1. Partisipasi Penelitian </b> <br>\r\nSilahkan centang beberapa jenis dari tipe partisipan yang akan terlibat dalam penelitian ini <br>\r\n1. Anak atau remaja dibawah 16 tahun<br>\r\n2. Ibu hamil dan menyusui<br>\r\n3. Masyarakat penyandang disabilitas<br>\r\n4. Profesional<br>\r\n5. Organisasi kemasyarakatan / Keagamaan<br>\r\n6. Pemerintahan Daerah<br>\r\n7. Pemerintahan Pusat<br>\r\n8. Pemerintahan Negara Lain<br>\r\n', '', 'textarea', 'centang_partisipan_penelitian', 15, 1, NULL),
(76, '<b> 2. Deskripsi Partisipan </b>\r\n<br>\r\nBerapa banyak kelompok partisipan yang terlibat dalam penelitian ini? Jelaskan secara singkat kelompok partisipan yang terlibat dalam penelitian ini!', '', 'textarea', 'kelompok_partisipan_terlibat', 15, 2, NULL),
(77, 'Berapa jumlah partisipan yang diharapkan untuk terlibat dalam penelitian ini? Jelaskan secara singkat partisipan yang diharapkan untuk terlibat dalam penelitian ini!', '', 'textarea', 'jumlah_partisipan', 15, 3, NULL),
(78, 'Jelaskan karakteristik tertentu dari kelompok partisipan yang dilibatkan  dan alasannya yang relevan dibalik penetuean karakteristik tersebut dengan tujuan penelitian?Uraikan', '', 'textarea', 'karakteristik_kelompok_partisipan', 15, 4, NULL),
(79, 'Apakah terdapat partisipan atau kelompok partisipan tertentu yang dikeluarkan dari penelitian ini? ', '', 'radio', 'keluarkan_partisipan_penelitian', 15, 5, NULL),
(80, 'Dalam menjawab pertanyaan diatas, anda perlu mempertimbangkan apakah adil atau tidak untuk mengeluarkan partisipan tersebut (uraikan jika ada)!', '', 'textarea', 'mempertimbangkan_mengeluarkan_partisipan', 15, 6, NULL),
(81, '<b> 3. Uraian Kepada Partisipan Penelitian </b>\r\n<br>\r\nBerikan uraian terperinci yang singkat tentang apa yang diharapkan peneliti pada partisipan dalam proses partisipasi nya dalam penelitian ini ', '', 'textarea', 'uraian_terperinci_penelitian', 15, 7, NULL),
(82, 'Tentukan sifat dari setiap hubungan yang ada atau yang mungkin meningkat selama penelitian, antara calon partisipan dan anggota tim peneliti atau organisasi yang terlibat dalam penelitian.  ', '', 'textarea', 'sifat_hubungan_peneliti', 15, 8, NULL),
(83, 'Apakah penelitian akan berdampak atau mengubah hubungan yang ada antara partisipan dan peneliti atau organisasi? ', '', 'radio', 'penelitian_berdampak_organisasi', 15, 9, NULL),
(84, 'Jika iya, Uraikan jawaban anda! ', '', 'textarea', 'uraikan_dampak_kelompok', 15, 10, NULL),
(85, 'Apakah transkrip wawancara akan ditunjukan kepada partisipan atau tidak?', '', 'radio', 'transkrip_wawancara', 15, 11, NULL),
(86, 'Mengapa penting bagi partisipan untuk mengetahui atau tidak mengetahui informasi ini?', '', 'textarea', 'partisipan_mengetahui_informasi', 15, 12, NULL),
(87, 'Proses apa yang akan digunakan untuk mengidentifikasi calon partisipan penelitian?', '', 'textarea', 'mengidentifikasi_calon_partisipan', 15, 13, NULL),
(88, 'Jelaskan bagaimana kontak awal akan dilakukan dengan calon partisipan penelitian?', '', 'textarea', 'kontak_awal', 15, 14, NULL),
(89, 'Apakah anda akan melibatkan pria dan wanita dalam penelitian ini?', '', 'radio', 'libatkan_wanita_penelitian', 15, 15, NULL),
(90, 'Berapa rasio antara laki-laki dan perempuan yang akan direkrut dalam penelitian ini dan apakah rasio tersebut secara akurat telah mencerminkan distribusi pemahaman masalah atau kondisi dalam masyarakat umum?', '', 'textarea', 'rasio_antara_lakiperem', 15, 16, NULL),
(91, 'Apakah iklan, email, situs web, surat, atau panggilan telepon digunakan sebagai bentuk kontak awal dengan calon partisipan?', '', 'textarea', 'iklan_kontak_awal', 15, 17, NULL),
(92, 'Berikan rincian dan salinan dari teks/skrip yang digunakan diatas', '', 'textarea', 'skrip_digunakan', 15, 18, NULL),
(93, 'Apakah terdapat resiko apabila seseorang berhasil direkrut untuk berpartisipasi atau apabila dikeluarkan dari penelitian ini?', '', 'textarea', 'resiko_direkrut_penelitian', 15, 19, NULL),
(94, 'Apakah persetujuan untuk berpartisipasi dalam penelitian ini akan diminta kepada semua partisipan?', '', 'radio', 'persetujuan_semuapartisipan', 15, 20, NULL),
(95, 'Jika tidak, uraikan jawaban anda!', '', 'textarea', 'tidak_partisipan_uraikan', 15, 21, NULL),
(96, 'Apakah ada partisipan yang memiliki kapasitas untuk memberikan persetujuan untuk diri mereka sendiri?', '', 'radio', 'persetujuan_partisipan', 15, 22, NULL),
(97, 'Jika iya, uraikan jawaban anda!', '', 'textarea', 'uraikan_persetujuan_partisipan', 15, 23, NULL),
(98, 'Mekanisme / penilaian / alat apa yang digunakan untuk dijadikan indikator masing-masing partisipan apakah akan berpartisipasi atau tidak? ', '', 'textarea', 'mekanisme_indikator', 15, 24, NULL),
(99, 'Apakah ada partisipan anak-anak atau remaja? ', '', 'radio', 'partisipan_anakanak', 15, 25, NULL),
(100, 'Apakah akan ada partisipan yang tidak memiliki kapasitas untuk memberikan persetujuan untuk diri mereka sendiri? ', '', 'radio', 'persetujuan_partisipan_kapasitas', 15, 26, NULL),
(101, 'Jelaskan dan uraikan bagaimana proses partisipan dalam memutuskan setuju atau tidak untuk berpartisipasi dalam proyek?', '', 'textarea', 'proses_memutuskan_setuju', 15, 27, NULL),
(102, 'Jika seorang partisipan memutuskan untuk tidak berpartisipasi, adakah konsekuensi khusus yang harus mereka ketahui, sebelum membuat keputusan ini? ', '', 'textarea', 'tidak_berpartisipasi', 15, 28, NULL),
(103, 'Jika partisipan memilih untuk menarik diri dari penelitian, adakah konsekuensi khusus yang harus mereka ketahui sebelum memberikan persetujuan? ', '', 'textarea', 'menarik_diri_penelitian', 15, 29, NULL),
(104, 'Tentukan bentuk dari insentif / keuntungan yang akan diberikan kepada partisipan penelitian ini (mis. Tiket film, voucher makanan atau penggantian biaya perjalanan).', '', 'textarea', 'insentif_keuntungan', 15, 30, NULL),
(105, 'Jelaskan mengapa penawaran ini tidak akan merusak sifat suka rela dari persetujuan, baik oleh partisipan atau orang yang mewakili partisipan', '', 'textarea', 'penawaran_sukarela', 15, 31, NULL),
(106, 'Apakah terdapat persetujuan dari masing-masing partisipan untuk penggunaan data / sampel tersimpan mereka untuk proyek penelitian ini? ', '', 'radio', 'persetujuan_partisipan_penelitian', 15, 32, NULL),
(107, '<b> J. SPESIFIKASI PARTISIPAN </b> <br>\r\n1.Apakah terdapat Partisipan yang bahasa utamanya adalah selain bahasa Indonesia?', '', 'radio', 'bahasa_utama_partisipan', 16, 1, NULL),
(108, '2.Jelaskan langkah-langkah apa yang akan diambil untuk memastikan persetujuan partisipan untuk berpartisipasi dalam proyek mengingat bahwa bahasa utama orang tersebut adalah selain bahasa Indonesia', '', 'textarea', 'persetujuan_partisipan_bahasa', 16, 2, NULL),
(109, '3.Dalam bahasa apa penelitian akan dilakukan? <br>\r\n- Bahasa Indonesia <br>\r\n- Bahasa Daerah, sebutkan dikolom bawah <br> \r\n- Bahasa Inggris <br>\r\n', NULL, 'textarea', 'bahasa_penelitian', 16, 3, NULL),
(110, '4.Apakah juru bahasa akan hadir selama diskusi dengan para partisipan terkait proyek penelitian? ', '', 'radio', 'juru_bahasa_hadir', 16, 4, NULL),
(111, 'Jika tidak mohon paparkan penjelasan dibawah', '', 'textarea', 'juru_tidak_hadir', 16, 5, NULL),
(112, '5.Apakah partisipan akan diberikan informasi tertulis terkait dimana penelitian akan dilakukan? ', '', 'radio', 'partisipan_dimana_penelitian', 16, 6, NULL),
(113, '6.Sensitivas budaya apa yang relevan dengan para partisipan dalam proyek penelitian ini?', '', 'textarea', 'sensitivas_budaya', 16, 7, NULL),
(114, '<b> J.Kerahasiaan </b> <br>\r\n1.Apakah persetujuan privasi perlu diterapkan dalam ijin etika penelitian sosial kemasyarakatan ini?', '', 'radio', 'persetujuan_privasi', 17, 1, NULL),
(115, '2.Sebutkan sumber informasi tentang partisipan yang akan digunakan dalam proyek penelitian ini', '', 'textarea', 'sumber_informasi_partisipan', 17, 2, NULL),
(116, '3.Jelaskan informasi yang akan dikumpulkan langsung dari partisipan. Jelaskan secara spesifik bila perlu', '', 'textarea', 'informasi_spesifik', 17, 3, NULL),
(117, '4.Bentuk informasi yang dikumpulkan oleh tim peneliti dari partisipan adalah sebagai berikut : <br> \r\n1. Dapat diidentifikasi <br>\r\n2. Tidak dapat diidentifikasi\r\n', '', 'textarea', 'informasi_identifikasi', 17, 4, NULL),
(118, '5.Jelaskan bagaimana informasi yang dikumpulkan tentang partisipan akan digunakan dalam penelitian ini. ', '', 'textarea', 'informasi_dikumpulkan_peneliti', 17, 5, NULL),
(119, '6. Apakah ada informasi yang digunakan oleh tim peneliti dalam bentuk yang dapat langsung diidentifikasi atau diidentifikasikan kembali (dikodekan)?   ', '', 'textarea', 'dikodekan_informasi', 17, 6, NULL),
(120, '7. Apakah segala macam bentuk informasi yang dikumpulkan digunakan dan dihasilkan oleh penelitian ini tidak akan digunakan untuk tujuan lain? ', '', 'textarea', 'tujuan_lain_informasi', 17, 7, NULL),
(121, '8. Buatlah daftar SEMUA personel peneliti dan orang lain yang memiliki wewenang untuk menggunakan atau memiliki akses informasi dan menggambarkan sifat penggunaan atau akses tersebut. (Contoh lain adalah: pembimbing mahasiswa, pengolah data)', '', 'textarea', 'informasi_spesifik', 17, 8, NULL),
(122, '9. Dalam format apa informasi akan disimpan selama dan setelah proyek penelitian? (mis. salinan kertas, file komputer pada hard disk atau CD, pita audio, kaset video, film) ', '', 'textarea', 'kaset_disimpan_penelitian', 17, 9, NULL),
(123, '10. Langkah-langkah apa yang harus diambil untuk memastikan agar keamanan informasi terhindar dari penyalahgunaan, kehilangan , atau akses tidak sah selama dan setelah proyek penelitian? (mis. Apakah informasi akan disimpan secara fisik dalam penyimpanan yang terkunci atau di password?) ', '', 'textarea', 'keamanaan_data_penelitian', 17, 10, NULL),
(124, '11. Untuk berapa lama informasi penelitian yang didapat akan disimpan setelah penelitian selesai dan mengapa?', '', 'textarea', 'lama_informasi_disimpan', 17, 11, NULL),
(125, '12. Siapa yang memiliki informasi hasil dari penelitian, misalnya. laporan akhir atau hasil yang dipublikasikan? ', '', 'textarea', 'pemilik_informasi_penelitian', 17, 12, NULL),
(126, '13. Apakah pemilik informasi atau pihak lain mana pun memiliki hak untuk membuat batasan atau ketentuan pada publikasi hasil proyek ini? \r\n', '', 'radio', 'hak_batasan_publikasi', 17, 13, NULL),
(127, '14. Jelaskan batasan pada publikasi ', '', 'textarea', 'jelaskan_batasan_publikasi', 17, 14, NULL),
(128, '15. Apakah informasi yang dikumpulkan, digunakan, atau dihasilkan oleh proyek ini akan dihapus pada tahap tertentu?  ', '', 'radio', 'proyek_dihapus', 17, 15, NULL),
(129, '16. Pada tahap apa informasi akan dihapus? ', '', 'textarea', 'tahap_informasi_dihapus', 17, 16, NULL),
(130, '17. Bagaimana informasi (dalam segala bentuk)  akan dihapus?', '', 'textarea', 'bentuk_informasi_dihapus', 17, 17, NULL),
(131, '18. Apakah hasil penelitian yang terkait dengan partisipan tertentu akan dilaporkan kepada partisipan penelitian tersebut?  ', '', 'radio', 'penelitian_dilaporkan_partisipan', 17, 18, NULL),
(132, '19. Tentukan dalam bentuk apa hasil penelitian akan dilaporkan kepada partisipan?  ', '', 'textarea', 'bentuk_laporan_partisipan', 17, 19, NULL),
(133, '20. Bagaimana hasilnya akan dikomunikasikan kepada partisipan? mis. panggilan telepon, surat pribadi, salinan publikasi, konsultasi dengan praktisi medis dll.', '', 'textarea', 'hasil_komunikasi', 17, 20, NULL),
(134, '21. Siapa yang akan bertanggung jawab untuk mengkomunikasikan hasil proyek kepada para partisipan? ', '', 'textarea', 'penanggung_jawab_komunikasi', 17, 21, NULL),
(135, '22. Apakah penelitian cenderung menghasilkan informasi penting bagi partisipan? ', '', 'radio', 'penelitian_menghasilkan_informasi', 17, 22, NULL),
(136, '23. Apakah hasil yang terkait dengan partisipan tertentu akan dilaporkan kepada siapa pun selain partisipan?', '', 'radio', 'laporan_selain_partisipan', 17, 23, NULL),
(137, '24. Apakah penelitian cenderung memiliki risiko yang signifikan terhadap kesehatan atau kesejahteraan orang lain selain partisipan, misalnya anggota keluarga, kolega ? ', '', 'radio', 'risiko_signifikan', 17, 24, NULL),
(138, 'Jika iya, uraikan jawaban anda!', '', 'textarea', 'uraikkan_risiko_signifikan', 17, 25, NULL),
(139, '25. Apakah ada risiko dari penyebaran hasil yang dapat menyebabkan bahaya apa pun. kepada partisipan perorangan - apakah kesejahteraan fisik, psikologis, spiritual, emosional, sosial atau keuangan mereka, atau terhadap kemampuan kerja atau hubungan profesional mereka - atau ke komunitas mereka? ', '', 'textarea', 'risiko_penyebaran_hasil', 17, 26, NULL),
(140, '26. Bagaimana laporan hasil penelitian akan disebarluaskan? ', '', 'textarea', 'penyebaraluasan_hasil_pnelitian', 17, 27, NULL),
(141, '27. Apakah kerahasiaan dan data partisipan akan dilindungi hasil penelitian disebarkan? ', '', 'radio', 'lindungi_hasil_penelitian', 17, 28, NULL),
(142, '28. Jelaskan bagaimana kerahasiaan partisipan dan data mereka akan dilindungi dalam penyebaran hasil penelitian', '', 'textarea', 'kerahasiaan_partisipan', 17, 29, NULL),
(143, '<b> L. SPESIFIKASI PROYEK </b> <br>\r\n<b> 1.Penelitian yang dilakukan di Luar Negeri </b> <br>\r\nApakah Penelitian Ini akan di lakukan di luar Negeri?', '', 'radio', 'penelitian_dilakukan_luarnegeri', 18, 1, NULL),
(144, 'Bagaimana peneliti utama akan penelitian yang akan bekerja di luar negeri?', '', 'textarea', 'peneliti_akan_bekerja', 18, 2, NULL),
(145, 'Atas dasar hukum apa penelitian tersebut sah untuk dilakukan ditempat penelitian di Luar Negeri?', '', 'textarea', 'dasar_hukum_penelitian', 18, 3, NULL),
(146, 'Apakah penelitian ini akan melibatkan akses ke penggunaan, pengumpulan atau perolehan artefak yang sensitif secara budaya? ', '', 'textarea', 'peneliti_melibatkan_budaya', 18, 4, NULL),
(147, 'Apakah ada faktor lokal yang berbenturan dengan penelitian ini?', '', 'textarea', 'faktor_berbenturan_penelitian', 18, 5, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT 1,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`id`, `name`, `parent_id`, `visible`, `description`) VALUES
(1, 'Formulir Ijin Etika Penelitian Sosial Kemasyarakatan Pascasarjana MIA FISIP UNEJ <br>\r\nBAGIAN I', NULL, 1, ''),
(2, 'PART A', 1, 1, ''),
(3, 'PART B', 1, 1, ''),
(4, 'PART C', 1, 1, '<b> Dosen Pembimbing </b>'),
(5, 'PART D', 1, 1, 'Asisten Penelitian'),
(6, 'PART E', 1, 1, '<b> Pihak-pihak Lain yang Terlibat dalam Penelitian </b>'),
(9, 'PART F', 1, 1, ''),
(10, 'PART G', 1, 1, ''),
(13, 'Formulir Ijin Etika Penelitian Sosial Kemasyarakatan Pascasarjana MIA FISIP UNEJ <br> Bagian II', NULL, 1, ''),
(14, 'PART H', 13, 1, ''),
(15, 'PART I', 13, 1, ''),
(16, 'PART J', 13, 1, ''),
(17, 'PART K', 13, 1, ''),
(18, 'PART L', 13, 1, ''),
(19, 'PART M', 13, 1, ''),
(20, 'PART N', 13, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.com', NULL, '$2y$10$TCMYMVh2LchRkYz.0DEynuGJm9yztJPLXtirDjEtmR2VvcmQ2jPwC', 'g9dt15viCU666hnSHy2H3C6IpLhEb9Qwt9jTkOBzSF2VRLxAEoE8K4gKmfmC', '2019-07-27 09:37:59', '2019-07-27 09:37:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_question` (`id_question`),
  ADD KEY `id_mahasiswa` (`id_mahasiswa`);

--
-- Indexes for table `base_mata_kuliah`
--
ALTER TABLE `base_mata_kuliah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dosen_pembimbing`
--
ALTER TABLE `dosen_pembimbing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_mahasiswa` (`id_mahasiswa`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_mahasiswa` (`id_mahasiswa`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `section` (`section`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answer`
--
ALTER TABLE `answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `base_mata_kuliah`
--
ALTER TABLE `base_mata_kuliah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `dosen_pembimbing`
--
ALTER TABLE `dosen_pembimbing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answer`
--
ALTER TABLE `answer`
  ADD CONSTRAINT `answer_ibfk_1` FOREIGN KEY (`id_question`) REFERENCES `question` (`id`),
  ADD CONSTRAINT `answer_ibfk_2` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id`);

--
-- Constraints for table `dosen_pembimbing`
--
ALTER TABLE `dosen_pembimbing`
  ADD CONSTRAINT `dosen_pembimbing_ibfk_1` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id`);

--
-- Constraints for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD CONSTRAINT `mata_kuliah_ibfk_1` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id`);

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`section`) REFERENCES `section` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
