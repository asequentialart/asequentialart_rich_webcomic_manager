window.addEventListener("load", function() {
    activateMenu();
});
function activateMenu(){
    let request={
        type:1,
        comicTitle:'',
        comicID:'',
        action:'',
        comicJSON:'',
        imgs_mth:'',
        imgs_y:''
    };
    const aa_menu_s1=document.getElementById('aa_menu_s1');
    const aa_menu_s2=document.getElementById('aa_menu_s2');
    const aa_menu_s3a=document.getElementById('aa_menu_s3a');
    const aa_menu_s3b=document.getElementById('aa_menu_s3b');
    const aa_menu_s4=document.getElementById('aa_menu_s4');
    const aa_menu_s5=document.getElementById('aa_menu_s5');
    //
    const form1=document.getElementById('comicposts_form');
    const form2=document.getElementById('action_form');
    const form3a=document.getElementById('date_form');
    const form4=document.getElementById('JSON_form');
    //
    const selectcomic=document.getElementById("comicposts");
    const selectedaction=document.getElementById("enhcXdeenhc");
    const selectmonth=document.getElementById("uploadmonth");
    const selectyear=document.getElementById("uploadyear");
    const inputJson=document.getElementById("comicjson");
    //
    const btn= document.getElementById("comicname");
    const btn2=document.getElementById("eXde");
    const btn3a= document.getElementById("selectedmonth");
    const btn3b= document.getElementById("deenhance");
    const btn4= document.getElementById("uploadcomicjson");
    const btn5= document.getElementById("reset");
    //
    const check1=document.getElementById("step1_check");
    const check2=document.getElementById("step2_check");
    const check3a=document.getElementById("step3a_check");
    const check3b=document.getElementById("step3b_check");
    const check4=document.getElementById("step4_check");
    //
    btn.addEventListener('click',(event)=>{
        event.preventDefault();
        const val=selectcomic.value;
        const selectedOption= selectcomic.selectedOptions[0];
        const valId=selectedOption.dataset.id;
        request.comicTitle=val;
        request.comicID=valId;
        btn.classList.add("aa_none");
        check1.classList.remove("aa_none");
        aa_menu_s2.classList.remove("aa_none");
        aa_menu_s5.classList.remove("aa_none");
        
    });
    btn2.addEventListener('click',(event)=>{
        event.preventDefault();
        const val_eXde=selectedaction.value;
        request.action=val_eXde;
        btn2.classList.add("aa_none");
        check2.classList.remove("aa_none");
        if (val_eXde==='enhance'){
            aa_menu_s3a.classList.remove("aa_none");
        }else if (val_eXde==='de-enhance'){
            aa_menu_s3b.classList.remove("aa_none");
        }
        
    });
    btn3a.addEventListener('click',(event)=>{
        event.preventDefault();
        const valm=selectmonth.value;
        const valy=selectyear.value;
        request.imgs_mth=valm;
        request.imgs_y=valy;
        btn3a.classList.add("aa_none");
        check3a.classList.remove("aa_none");
        aa_menu_s4.classList.remove("aa_none");
    });
    btn3b.addEventListener('click',(event)=>{
        event.preventDefault();
        senddata(request);
        check3b.classList.remove("aa_none");
        //console.log(request);
        
    });
    btn4.addEventListener('click',(event)=>{
        event.preventDefault();
        const val=inputJson.value;
        let processedJson=JSON.parse(val);
        processedJson.u_date={year:request.imgs_y,month:request.imgs_mth};
        const restrngf_json=JSON.stringify(processedJson);
        request.comicJSON=restrngf_json;
        senddata(request);
        btn4.classList.add("aa_none");
        check4.classList.remove("aa_none");
    });
    btn5.addEventListener('click',(event)=>{
        event.preventDefault();
        form1.reset();
        if (!check1.classList.contains("aa_none")){check1.classList.add("aa_none")}
        if (btn.classList.contains("aa_none")){btn.classList.remove("aa_none")}
        form2.reset();
        if (!check2.classList.contains("aa_none")){check2.classList.add("aa_none")}
        if (!aa_menu_s2.classList.contains("aa_none")){aa_menu_s2.classList.add("aa_none")}
        if (btn2.classList.contains("aa_none")){btn2.classList.remove("aa_none")}
        form3a.reset();
        if (!check3a.classList.contains("aa_none")){check3a.classList.add("aa_none")};
        if (!aa_menu_s3a.classList.contains("aa_none")){aa_menu_s3a.classList.add("aa_none")}
        if (btn3a.classList.contains("aa_none")){btn3a.classList.remove("aa_none")}
        if (!check3b.classList.contains("aa_none")){check3b.classList.add("aa_none")}
        if (!aa_menu_s3b.classList.contains("aa_none")){aa_menu_s3b.classList.add("aa_none")}
        if (btn3b.classList.contains("aa_none")){btn3b.classList.remove("aa_none")}
        form4.reset();
        if (!check4.classList.contains("aa_none")){check4.classList.add("aa_none")}
        if (!aa_menu_s4.classList.contains("aa_none")){aa_menu_s4.classList.add("aa_none")}
        if (btn4.classList.contains("aa_none")){btn4.classList.remove("aa_none")}
        aa_menu_s5.classList.add("aa_none");
        request={
        type:1,
        comicTitle:'',
        comicID:'',
        action:'',
        comicJSON:'',
        imgs_mth:'',
        imgs_y:''
        };
        
    });
    }
    function senddata(request){
        const api=myscript_object.pathsArray.home_URL;
        const apiroute=api+"/wp-json/asequentialart/v1/json";
        fetch(apiroute,{
            method:'POST',
            headers:{
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(request),
        })
        .then(response=>response.json())
        .then(result =>{
            console.log('Success',result);
        })
        .catch(error =>{
            console.error('Error:' , error);
        })
    }