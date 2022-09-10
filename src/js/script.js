$(function(){
    var wrapper_childs = [$(".reg"), $(".auth"), $(".profile"), $(".cart")];
    var wrapper = $("#wrapper");
    wrapper.hide();

    function hideWrapChilds(){
        wrapper_childs.forEach(e => {
            e.hide();
            console.log(e.length);
        });
    }

    hideWrapChilds();

    $("#profile").on("click", function(){
        if(wrapper_childs[2].length != 0){
            $(".auth").show();
        }
        else{
            $(".profile").show();
        }
        wrapper.show(500);
    });
    $(".wrapper__header img").on("click", function(){
        wrapper.hide(500);
        hideWrapChilds();
    });
    $(".busket__button").on("click", function(){
        $(".cart").show();
        wrapper.show(500);
    })
    $(".switch__form").on("click", function(){
        $(".reg").toggle();
        $(".auth").toggle();
    })
})