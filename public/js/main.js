// 削除時のアラート
// classがpost_deleteのものをクリックされたら
$('.delete_button').on('click', function() {
    
    // キャンセルが押されたら処理をやめる
    if(!confirm('削除してもよろしいですか？')){
        return false;
    }
    
    // この投稿のvalueの値を取得
    const target_id = $(this).val();
    
    // idがform_post_idのvalueにtarget_idを代入
    $('#delete_id').val(target_id);
    
    // classがdelete_formのものを送信
    $('.delete_form').submit();
});

// いいね時のアラート
// classがpost_favoriteのものをクリックされたら
$('.favorite_button').on('click', function() {
    
    // キャンセルが押されたら処理をやめる
    if(!confirm('いいねしますか？')){
        return false;
    }
    
    // この投稿のvalueの値を取得
    const target_id = $(this).val();
    
    // idがform_favorite_idのvalueにtarget_idを代入
    $('#favorite_id').val(target_id);
    
    // classがfavorite_formのものを送信
    $('.favorite_form').submit();
});

// いいね解除時のアラート
// classがunfavorite_buttonのものがクリックされたら
$('.unfavorite_button').on('click', function() {
    
    // キャンセルが押されたら処理をやめる
    if(!confirm('いいねやめますか？')){
        return false;
    }
    
    // この投稿のvalueの値を取得
    const target_id = $(this).val();
    
    // idがunfavorite_idのvalueにtarget_idを代入
    $('#unfavorite_id').val(target_id);
    
    // classがunfavorite_formのものを送信
    $('.unfavorite_form').submit();
});

// ログアウト時のアラート
// idがlogoutのものがクリックされたら
$('#logout').on('click', function() {
    
    // キャンセルが押されたら処理をやめる
    if(!confirm('ログアウトしますか？')){
        return false;
    }
    
    // OKが押されたらアラートを表示
    alert('さようなら');
});

// フォロー時のアラート
// classがfollow_buttonのものがクリックされたら
$('.follow_button').on('click', function() {
    
    // キャンセルが押されたら処理をやめる
    if(!confirm('フォローしますか？')){
        return false;
    }
    
    // この投稿のvalueの値を取得
    const target_id = $(this).val();
    
    // idがfollow_idのvalueにtarget_idを代入
    $('#follow_id').val(target_id);
    
    // classがfollow_formのものを送信
    $('.follow_form').submit();
});

// アンフォロー時のアラート
$('.unfollow_button').on('click', function() {
    
    // キャンセルが押されたら処理をやめる
    if(!confirm('フォローをはずしますか？')){
        return false;
    }
    
    // この投稿のvalueの値を取得
    const target_id = $(this).val();
    
    // idがfollow_idのvalueにtarget_idを代入
    $('#unfollow_id').val(target_id);
    
    // classがfollow_formのものを送信
    $('.unfollow_form').submit();
});