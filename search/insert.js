var preloader = document.getElementById("loading");
function myfunction() {
  preloader.style.display = "none";
}

////////////////////////////////////////////// form creation //////////////////////////////////////////////////////////



function doit() {
  // const form=document.querySelector(".form");

  const clone_form = document.querySelector(".formnew").cloneNode(true);
  const deptcheck = (document.getElementById('deptcheck'))
  const tagscheck = (document.getElementById('Tagscheck'))
  const locationcheck = (document.getElementById('locationcheck'))
  const statuscheck = (document.getElementById('statuscheck'))
  const personcheck = (document.getElementById('personcheck'))

  const currentDept=document.querySelector("#dept")
  // console.log(currentDept)

  const current=document.querySelector(".btn");
  clone_form.childNodes[5].childNodes[1].childNodes[1].name='serial-'+(parseInt(current.id)+1);
  clone_form.childNodes[5].childNodes[1].childNodes[1].value='';
  // clone_form.childNodes[1].childNodes[5].childNodes[5].childNodes[1].name='allotment-'+(parseInt(current.id)+1);
  // clone_form.childNodes[1].childNodes[5].childNodes[5].childNodes[1].value='';
  // clone_form.childNodes[1].childNodes[5].childNodes[3].childNodes[1].name='status-'+(parseInt(current.id)+1);
  // clone_form.childNodes[1].childNodes[5].childNodes[3].childNodes[1].value='';
  // console.log(clone_form.childNodes[1].childNodes[5].childNodes[3].childNodes[1])
  if(deptcheck.checked){
    // const temp = document.createElement("label")
    // temp.innerHTML =  deptcheck.options[deptcheck.selectedIndex].value
    (clone_form.childNodes[5].childNodes[5].childNodes[3]).style.display= 'none';
    // console.log('HelloWorld')
    // (clone_form.childNodes[5].childNodes[5]).appendChild(temp)
  }else{
    (clone_form.childNodes[5].childNodes[5].childNodes[3]).name= 'dept-'+(parseInt(current.id)+1);
  }
  if(tagscheck.checked){
    // const temp = document.createElement("label")
    // temp.innerHTML =  deptcheck.options[deptcheck.selectedIndex].value
    (clone_form.childNodes[7].childNodes[1]).style.display= 'none';
    // console.log('HelloWorld')
    // (clone_form.childNodes[5].childNodes[5]).appendChild(temp)
  }else{
    (clone_form.childNodes[7].childNodes[1]).name= 'tags-'+(parseInt(current.id)+1);
  }
  if(locationcheck.checked){
    // const temp = document.createElement("label")
    // temp.innerHTML =  deptcheck.options[deptcheck.selectedIndex].value
    (clone_form.childNodes[7].childNodes[5]).style.display= 'none';
    // console.log('HelloWorld')
    // (clone_form.childNodes[5].childNodes[5]).appendChild(temp)
  }else{
    (clone_form.childNodes[7].childNodes[5]).name= 'location-'+(parseInt(current.id)+1);
  }
  console.log(clone_form.childNodes[7].childNodes[7])
  if(personcheck.checked){
    // const temp = document.createElement("label")
    // temp.innerHTML =  deptcheck.options[deptcheck.selectedIndex].value
    (clone_form.childNodes[7].childNodes[7]).style.display= 'none';
    // console.log('HelloWorld')
    
  }else{
    (clone_form.childNodes[7].childNodes[7]).name= 'person-'+(parseInt(current.id)+1);
  }
  if(statuscheck.checked){
    // const temp = document.createElement("label")
    // temp.innerHTML =  deptcheck.options[deptcheck.selectedIndex].value
    (clone_form.childNodes[7].childNodes[3]).style.display= 'none';
    // console.log('HelloWorld')
    // (clone_form.childNodes[5].childNodes[5]).appendChild(temp)
  }else{
    (clone_form.childNodes[7].childNodes[3]).name= 'status-'+(parseInt(current.id)+1);
  }


  const demo=document.querySelector('form');
  // clone_form.childNodes[1].childNodes[3].childNodes[5].childNodes[1].options.selectedIndex=parseInt(currentDept.id)-1;
// console.log(clone_form.childNodes[7].childNodes[3])
  current.id=parseInt(current.id)+1;
  demo.appendChild(clone_form)
  
}


function add(){
  const val = document.querySelector("#number-no").value;

  for(i=1;i<=val;i++){
    doit();
    document.querySelector('#hidden').value= parseInt(document.querySelector('#hidden').value)+1

  }
}


// function select()
// {
//   var decide =(document.querySelector('#perid').value)
//   if(decide == 1)
//   {
//     document.querySelector('#location').style.display='none'
//     document.querySelector('#person').style.display ='block'
//   }
//   else{

//     document.querySelector('#location').style.display='block'
//     document.querySelector('#person').style.display ='none'
//   }
// }

// function select()
// {
//   var decide =(document.querySelector('#perid').value)
//   if(decide == 1)
//   {
//     document.querySelector('#locationcheck').style.display='none'
//     document.querySelector('#personcheck').style.display ='block'
//   }
//   else{

//     document.querySelector('#locationcheck').style.display='block'
//     document.querySelector('#personcheck').style.display ='none'
//   }
// }