<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryIdColToProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // aggiungo la col cat_id a products
            $table->unsignedBigInteger('category_id')->nullable()->after('slug');

            // scrivo che l'id di cat_id fa riferimento all'id della tab categories
            $table->foreign('category_id')
            ->references('id')
            ->on('categories')
            ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign('products_category_id_foreign');

            $table->dropColumn('category_id');
        });
    }
}
