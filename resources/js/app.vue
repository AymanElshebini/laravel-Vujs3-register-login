<script setup>
import {ref} from 'vue';
import TopBarComponent from "./layouts/TopBarComponent.vue";
import FooterComponent from "./layouts/FooterComponent.vue";
const user=ref('')
axios.get('/user').then(res=>{
    user.value=res.data.user
});
const token=localStorage.getItem('token');
</script>


<template>

       
    <main>
      <TopBarComponent></TopBarComponent>
    
        <router-view></router-view>
    <a id="scrollUp" href="#top" class="scrollUp">
  <i class="fa fa-angle-up">

  </i></a>
    </main>



    <FooterComponent></FooterComponent>
  

</template>