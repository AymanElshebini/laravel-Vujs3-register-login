<script setup>
import {ref} from 'vue';
/**declaer filed */
const name=ref('');
const email=ref('');
const password=ref('');
const password_confirmation=ref('');

/**check password  */
const confirmPass=()=>{
    if(password.value !== password_confirmation.value)
    {
        alert('password not match')
    }

 
}

const Register =()=>{
    if(name.value==='' || email.value==='' || password.value=== '' || password_confirmation.value === '')
    {
        alert('Please fill all fildes');

    }else {

    

    axios.post('/register',{
        name:name.value,
        email:email.value,
        password:password.value,
        password_confirmation:password_confirmation.value
    }).then((res)=>{
        console.log(res.data)
        localStorage.setItem('token',res.data.access_token)
      //  localStorage.setItem('user',JSON.stringify(res.data.user))
        window.location.href='/admin'

    }).catch((err)=>{
        console.log(err)

    })
}
}   



</script>



<template>
<div class="container-fluid">
    <div class="row">
        <div class="card">
            <section class="vh-100" style="background-color: #2779e2;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-9">

        <h1 class="text-white mb-4">Create an Account!</h1>

        <div class="card" style="border-radius: 15px;">
          <div class="card-body">

            <div class="row align-items-center pt-4 pb-3">
              <div class="col-md-3 ps-5">

                <h6 class="mb-0">Full name</h6>

              </div>
              <div class="col-md-9 pe-5">

                <input type="text" class="form-control form-control-lg" v-model="name" placeholder="name"  />

              </div>
            </div>

            <hr class="mx-n3">

            <div class="row align-items-center py-3">
              <div class="col-md-3 ps-5">

                <h6 class="mb-0">Email address</h6>

              </div>
              <div class="col-md-9 pe-5">

                <input type="email" v-model="email" class="form-control form-control-lg" 
                placeholder="example@example.com" />

              </div>
            </div>

          
            <div class="row align-items-center py-3">
              <div class="col-md-3 ps-5">

                <h6 class="mb-0">password</h6>

              </div>
              <div class="col-md-9 pe-5">

                <input type="password" v-model="password" class="form-control form-control-lg" 
                placeholder="password" />

              </div>
            </div>
            <div class="row align-items-center py-3">
              <div class="col-md-3 ps-5">

                <h6 class="mb-0">password</h6>

              </div>
              <div class="col-md-9 pe-5">

                <input type="password" @change="confirmPass()"  v-model="password_confirmation" class="form-control form-control-lg" 
                placeholder="password" />

              </div>
            </div>

            <hr class="mx-n3">
            <div class="px-5 py-4">
              <button type="submit"  @click="Register()" class="btn btn-primary btn-lg"> Register Account</button>
            </div>
          
          </div>
        </div>

      </div>
    </div>
  </div>
</section>
        </div>
    </div>
    
</div>
</template>