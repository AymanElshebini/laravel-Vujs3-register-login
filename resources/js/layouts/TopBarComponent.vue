<script setup>
import {ref} from 'vue';
const user=ref('');
const token=localStorage.getItem('token');
axios.get('/user').then(res=>{
    user.value=res.data.user
});

const logout=()=>{
    axios.get('/logout').then((res)=>{
        /**delete token */
       localStorage.removeItem('token')
        window.location.href='/login'
    }).catch((err)=>{
        console.log(err)

    })
     /**if not have token page will go to login screen */
    localStorage.removeItem('token')
        window.location.href='/login'

    }


</script>

<template>
   <nav class="navbar navbar-expand-lg ">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Elsherbini code</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <router-link to="/Register" class="nav-link active">
            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
            Register
                          
                       </router-link>
          
      
        </li>
        <li class="nav-item">
          <router-link to="/login" class="nav-link">
            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
            login
                          
                       </router-link>
     
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{ user.name }}
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><a class="dropdown-item" href="#" @click="logout()">Logout</a></li>
            
          </ul>
        </li>
        
      </ul>
     
    </div>
  </div>
</nav>
</template>