<?php

?>
<div class="container">
   <div class="card shadow mb-md-4 d-flex flex-column justify-content-center align-items-center">
       <h1 class="display-5 title-add">Новая заявка</h1>
       <div class="frame main_block ">

        <form id="calc_form" method="post" autocomplete="off">

            <div id="from_p">
                <label for="delivery_note">Откуда:</label>
                <input required="" type="text" id="city_0" name="city_0" value="" class="autocity ui-autocomplete-input" autocomplete="off">
                <span role="status" aria-live="polite" class="ui-helper-hidden-accessible">

        </span>
                <input type="hidden" id="citycode_0" name="citycode_0" value="">
            </div>

            <div id="to_p">

                <label for="delivery_note">Куда:</label>
                <input required="" type="text" id="city_1" name="city_1" value="" class="autocity ui-autocomplete-input" autocomplete="off">
                <span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>
                <input type="hidden" id="citycode_1" name="citycode_1" value="">

            </div>

            <table border="0" class="gab">
                <tbody>
                <tr id="calc_th">
                    <td><span>Высота:</span></td>
                    <td><span>Длина:</span></td>
                    <td><span>Ширина:</span></td>
                    <td><span>Вес:</span></td>
                    <td style="width:77px;"></td>
                </tr>
                <tr>
                    <td><span>см</span></td>
                    <td><span>см</span></td>
                    <td><span>см</span></td>
                    <td><span>кг</span></td>
                    <td style="width:77px;"></td>
                </tr>
                <tr id="row1">
                    <td width="100"><input type="number" class="r1" name="r1[]" min="0"></td>
                    <td width="100"><input type="number" class="r2" name="r2[]" min="0"></td>
                    <td width="100"><input type="number" class="r3" name="r3[]" min="0"></td>
                    <td width="100"><input type="text" class="ves" name="ves[]" value="1.00"></td>
                    <td style="text-align:right;">
                        <div class="wrbt">
                            <!--<div class="place_add" onClick="return AddNewPlace('1')" title="Добавить еще место">+</div>-->
                            <div class="place_add_copy" onclick="return CopyPlace('1')" title="Добавить место копированием">
                                <i class="fa fa-clone" aria-hidden="true"></i>
                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
            <p align="center">
                <button type="submit" name="calc_sub" class="btn btn-primary btn-icon-split" id="ok">
                    <span class="icon text-white-50">
                                   <i class="fas fa-arrow-right"></i>
                                </span>
                    <span class="text">Далее</span>
                </button>
            </p>
        </form>
    </div>
    </div>
</div>


