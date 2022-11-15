<script>
function alert(type,msg,position='body')
{
   let bs_class = (type =='success') ? 'alert-success' :'alert-danger';
   let element =document.createElement('div');
   element.innerHTML=`
   <div class="alert ${bs_class} alert-dismissible fade show  " role="alert">
    <strong class="me-2">${msg}</strong> 
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div> 
   `;
   
   if(position =='body'){
      document.body.append(element);
      element.classList.add('custom_alert')

   }
   else{
      document.getElementById(position).appendChild(element);
   }
   setTimeout(remALert,2000);
}

function remALert(){
   document.getElementsByClassName('alert')[0].remove();
}


</script>