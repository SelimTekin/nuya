$(document).ready(function () {
    
    var genislik    = window.screen.width;
    var yukseklik   = $("body").height();
    var howmuchOne = genislik - 50;
    var howmuchTwo = yukseklik - 125;
    var result, topFlag, colorCreator, colorList;

    for(var i = 0; i < howmuchOne;i++){ // left = 0 
        topFlag = 0;
        for(var j = 0; j < howmuchTwo;j++){ // top = 0
            result = Math.floor(Math.random() * 1000);
            if(result == 10){
                colorCreator    = Math.floor(Math.random() * 10);
                colorList       = ["rgb(202, 186, 126)", "#007bff", "#17a2b8", "#dc3545", "#ffc107", "#28a745", "#6c757d", "#343a40", "#f8f9fa", "#d8451a"];
                topFlag = 1;
                html = `
                    <div style="left:` + i + `px;top:` + j + `px;position: absolute;width: 50px;height: 50px;background-color: blue;border-radius: 50%;background-color: ` + colorList[colorCreator] + `;opacity:0.5"></div>
                `;
                $("body").prepend(html);
                j = j + 50;
            }
        }
        if(topFlag){
            i = i + 50;
        }
    }
});