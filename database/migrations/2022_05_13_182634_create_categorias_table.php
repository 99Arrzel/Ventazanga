<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('descripcion')->nullable();
            $table->foreignId('id_categoria_padre')->nullable()->constrained('categorias');
            $table->softDeletes();
            $table->timestamps();
        });
        $sql = "INSERT INTO link_v.categorias
(id, nombre, descripcion, id_categoria_padre, deleted_at, created_at, updated_at)
VALUES(1, 'componentes de computadora', 'nose', NULL, NULL, '2022-05-20 18:05:49', '2022-06-03 22:18:00');
INSERT INTO link_v.categorias
(id, nombre, descripcion, id_categoria_padre, deleted_at, created_at, updated_at)
VALUES(2, 'procesadores', 'asda', 1, NULL, '2022-05-20 19:18:30', '2022-05-20 20:06:58');
INSERT INTO link_v.categorias
(id, nombre, descripcion, id_categoria_padre, deleted_at, created_at, updated_at)
VALUES(6, 'autos', 'aaaa', NULL, NULL, '2022-05-20 19:19:37', '2022-06-03 22:18:29');
INSERT INTO link_v.categorias
(id, nombre, descripcion, id_categoria_padre, deleted_at, created_at, updated_at)
VALUES(7, 'motos', 'asdasd', NULL, NULL, '2022-05-20 19:20:06', '2022-06-03 22:18:37');
INSERT INTO link_v.categorias
(id, nombre, descripcion, id_categoria_padre, deleted_at, created_at, updated_at)
VALUES(11, 'componentes de laptop', '', NULL, NULL, '2022-05-20 19:28:52', '2022-06-03 22:23:11');
INSERT INTO link_v.categorias
(id, nombre, descripcion, id_categoria_padre, deleted_at, created_at, updated_at)
VALUES(16, 'celulares', 'zzzzzzzzzzzzzzzzzzzz', NULL, NULL, '2022-05-27 23:25:57', '2022-06-03 22:25:54');
INSERT INTO link_v.categorias
(id, nombre, descripcion, id_categoria_padre, deleted_at, created_at, updated_at)
VALUES(19, 'impresoras', '', NULL, NULL, '2022-05-27 23:43:21', '2022-06-03 22:26:02');
INSERT INTO link_v.categorias
(id, nombre, descripcion, id_categoria_padre, deleted_at, created_at, updated_at)
VALUES(21, 'almacenamiento', '', 1, NULL, '2022-05-27 23:44:06', '2022-06-03 22:17:00');
INSERT INTO link_v.categorias
(id, nombre, descripcion, id_categoria_padre, deleted_at, created_at, updated_at)
VALUES(22, 'memoria ram', '', 1, NULL, '2022-05-27 23:44:23', '2022-06-03 22:17:06');
INSERT INTO link_v.categorias
(id, nombre, descripcion, id_categoria_padre, deleted_at, created_at, updated_at)
VALUES(29, 'motor v8', '', 6, NULL, '2022-06-03 22:19:03', '2022-06-03 22:19:03');
INSERT INTO link_v.categorias
(id, nombre, descripcion, id_categoria_padre, deleted_at, created_at, updated_at)
VALUES(31, 'motor v4', '', 6, NULL, '2022-06-03 22:19:25', '2022-06-03 22:19:25');
INSERT INTO link_v.categorias
(id, nombre, descripcion, id_categoria_padre, deleted_at, created_at, updated_at)
VALUES(32, 'monocilindrica', '', 7, NULL, '2022-06-03 22:19:39', '2022-06-03 22:19:39');
INSERT INTO link_v.categorias
(id, nombre, descripcion, id_categoria_padre, deleted_at, created_at, updated_at)
VALUES(34, 'bicilindrica', '', 7, NULL, '2022-06-03 22:20:24', '2022-06-03 22:20:24');
INSERT INTO link_v.categorias
(id, nombre, descripcion, id_categoria_padre, deleted_at, created_at, updated_at)
VALUES(35, 'motor v4', '', 7, NULL, '2022-06-03 22:20:48', '2022-06-03 22:21:16');
INSERT INTO link_v.categorias
(id, nombre, descripcion, id_categoria_padre, deleted_at, created_at, updated_at)
VALUES(36, 'motor v10', '', 6, NULL, '2022-06-03 22:21:07', '2022-06-03 22:21:07');
INSERT INTO link_v.categorias
(id, nombre, descripcion, id_categoria_padre, deleted_at, created_at, updated_at)
VALUES(37, 'memoria ram', '', 11, NULL, '2022-06-03 22:23:26', '2022-06-03 22:23:26');
INSERT INTO link_v.categorias
(id, nombre, descripcion, id_categoria_padre, deleted_at, created_at, updated_at)
VALUES(38, 'ddr3', '', 22, NULL, '2022-06-03 22:23:34', '2022-06-03 22:23:34');
INSERT INTO link_v.categorias
(id, nombre, descripcion, id_categoria_padre, deleted_at, created_at, updated_at)
VALUES(39, 'ddr4', '', 22, NULL, '2022-06-03 22:23:41', '2022-06-03 22:23:41');
INSERT INTO link_v.categorias
(id, nombre, descripcion, id_categoria_padre, deleted_at, created_at, updated_at)
VALUES(40, 'ddr2', '', 22, NULL, '2022-06-03 22:23:49', '2022-06-03 22:23:49');
INSERT INTO link_v.categorias
(id, nombre, descripcion, id_categoria_padre, deleted_at, created_at, updated_at)
VALUES(41, 'impresoras 3d', '', NULL, NULL, '2022-06-03 22:26:08', '2022-06-03 22:26:08');
INSERT INTO link_v.categorias
(id, nombre, descripcion, id_categoria_padre, deleted_at, created_at, updated_at)
VALUES(42, 'alimentación', '', 19, NULL, '2022-06-03 22:26:47', '2022-06-03 22:26:47');
INSERT INTO link_v.categorias
(id, nombre, descripcion, id_categoria_padre, deleted_at, created_at, updated_at)
VALUES(43, 'inyeccion de tinta', '', 19, NULL, '2022-06-03 22:27:00', '2022-06-03 22:28:08');
INSERT INTO link_v.categorias
(id, nombre, descripcion, id_categoria_padre, deleted_at, created_at, updated_at)
VALUES(44, 'laser', '', 19, NULL, '2022-06-03 22:27:05', '2022-06-03 22:27:05');
INSERT INTO link_v.categorias
(id, nombre, descripcion, id_categoria_padre, deleted_at, created_at, updated_at)
VALUES(45, 'fdm', '', 41, NULL, '2022-06-03 22:27:11', '2022-06-03 22:27:11');
INSERT INTO link_v.categorias
(id, nombre, descripcion, id_categoria_padre, deleted_at, created_at, updated_at)
VALUES(46, 'resina', '', 41, NULL, '2022-06-03 22:27:15', '2022-06-03 22:27:15');
INSERT INTO link_v.categorias
(id, nombre, descripcion, id_categoria_padre, deleted_at, created_at, updated_at)
VALUES(47, 'toners', '', 44, NULL, '2022-06-03 22:27:26', '2022-06-03 22:27:26');
INSERT INTO link_v.categorias
(id, nombre, descripcion, id_categoria_padre, deleted_at, created_at, updated_at)
VALUES(48, 'tinta', '', 43, NULL, '2022-06-03 22:28:15', '2022-06-03 22:28:15');
INSERT INTO link_v.categorias
(id, nombre, descripcion, id_categoria_padre, deleted_at, created_at, updated_at)
VALUES(49, 'partes', '', 6, NULL, '2022-06-03 22:28:27', '2022-06-03 22:28:27');
INSERT INTO link_v.categorias
(id, nombre, descripcion, id_categoria_padre, deleted_at, created_at, updated_at)
VALUES(50, 'radiador', '', 49, NULL, '2022-06-03 22:28:33', '2022-06-03 22:28:33');
";
        DB::unprepared($sql);
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categorias');
    }
};
