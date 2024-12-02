
<?php
// database/migrations/create_makuls_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('makuls', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->string('nama_matkul');
            $table->integer('sks');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('makuls');
    }
};
?>