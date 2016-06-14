/**
 * Created by 马子航 on 2016/6/3.
 */


/**
 * 图片上传前预览
 */
function setImagePreview(docObj,localImag,imgObjPreview)
{
    if(docObj.files && docObj.files[0])
    {
        //火狐7以上版本不能用上面的getAsDataURL()方式获取，需要一下方式
        imgObjPreview.each(function (){
            this.src = window.URL.createObjectURL(docObj.files[0]);
        });
        $("#uploadavatarbtn").removeAttr("disabled");
    }
    else
    {
        //IE下，使用滤镜
        docObj.select();
        var imgSrc = document.selection.createRange().text;

        //图片异常的捕捉，防止用户修改后缀来伪造图片
        try
        {
            localImag.each(function (){
                this.style.filter="progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale)";
                this.filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = imgSrc;
            });
            $("#uploadavatarbtn").removeAttr("disabled");
        }
        catch(e)
        {
            alert("您上传的图片格式不正确，请重新选择!");
            return false;
        }
        imgObjPreview.each(function (){
            this.style.display = 'none';
        });
        document.selection.empty();
    }
    return true;
}