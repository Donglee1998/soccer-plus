<div class="modal" id="modalPassword" role="dialog">
    <div class="modal__wrapper">
        <span class="jsCloseModal btnClose">
            <svg class="icon">
                <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_close" />
            </svg>
        </span>
        <div class="modal__content">
            <p class="headline6 mb30 center">
                編集専用のパスワードを入力してください
            </p>
            <div class="blockUpload mb30">
                <ul class="blockUpload__name fullWidth">
                    <li class="pr0">
                        <input type="password" name="password_admin" placeholder="">
                    </li>
                </ul>
            </div>
            <p class="error" id="errorMatch">パスワードが違います。</p>
            <div class="btnGroup style01">
                <button type="submit" class="btnSubmit style01 pLeft {{$classTh}}">OK</button>
                <button class="btnSubmit style01 gray pRight jsCloseModal" href="#">キャンセル</button>
            </div>
        </div>
    </div>
</div>
