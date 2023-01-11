<template>

    <form
    id="form_main" 
    class="" 
    method="post"
     @submit.prevent="onSubmit"
       @keydown="form.errors.clear($event.target.name)" 
       >
       <div class="form-content">
   <div class="row">
     <div class="col-sm-12">
        <div class="msh"></div>
      </div>
                    <div class="col-md-6">
         
      
       <div class="form-group">
                        <label>Name *</label>

          <input
            name="name"
            id="name"
            class="form-control fm-cntrl"
            v-bind:class="form.errors.has('name')?'danger':''"
           placeholder="Name *"
            onfocus="this.placeholder = ''" 
            onblur="this.placeholder = 'Name *'"
            v-model="form.name"
          >
          <p class="error" v-if="form.errors.has('name')" v-text="form.errors.get('name')"></p>
        </div>

        <div class="form-group">
           <label>Phone Number*</label>

 <input
                  pattern="[0-9]*"
                  inputmode="numeric"
                  type="tel"
                  v-bind:class="form.errors.has('phone')?'danger':''"
                  maxlength="20"
                  class="form-control fm-cntrl phone"
                   placeholder="Contact Number *"
                   onfocus="this.placeholder = ''" 
                   onblur="this.placeholder = 'Contact Number *'"                  id="phone"
                  name="phone"
                  v-model="form.phone"
                >
                <span
                  class="error"
                  v-if="form.errors.has('phone')"
                  v-text="form.errors.get('phone')"
                ></span>
             

         
        </div>
     
         <div class="form-group">
                        <label>Number of Persons</label>
          <input
            name="person_nos"
            id="person_nos"
            class="form-control fm-cntrl"
            v-bind:class="form.errors.has('person_nos')?'danger':''"
             placeholder="No of persons *"
                   onfocus="this.placeholder = ''" 
                   onblur="this.placeholder = 'No of persons *'"
                 
            v-model="form.person_nos"
          >
          <p class="error" v-if="form.errors.has('person_nos')" v-text="form.errors.get('person_nos')"></p>

                </div>
 
        <div class="form-group">
                                  <label>Check - in</label>

                  <flat-pickr
             name="check_in"
               :config="config"
            id="check_in"
            class="form-control fm-cntrl"
            v-bind:class="form.errors.has('check_in')?'danger':''"
                    placeholder="Check In *"
                   onfocus="this.placeholder = ''" 
                   onblur="this.placeholder = 'Check In *'"
                             v-model="form.check_in"

          ></flat-pickr>
          <p class="error" v-if="form.errors.has('check_in')" v-text="form.errors.get('check_in')"></p>

        </div>
        
 
        
  <div class="form-group">
                        <label>Meal Plan</label>

                          <select
            name="meal_plan"
            id="meal_plan"
            class="form-control fm-cntrl"
            v-bind:class="form.errors.has('meal_plan')?'danger':''"
                    placeholder="Meal Plan*"
                   onfocus="this.placeholder = ''" 
                   onblur="this.placeholder = 'Meal Plan*'"
                             v-model="form.meal_plan"
          >
          <option value="">Select Meal Plan*</option>
         <option v-for="val in mealtyp()" :key="val.id" :value="val.id">{{val.name}}</option>

          </select>
          <p class="error" v-if="form.errors.has('meal_plan')" v-text="form.errors.get('meal_plan')"></p>
        </div>
</div>
<div class="col-md-6">
        <div class="form-group" id="check-in-datepiker" >
                                    <label>Email</label>


          <input
            name="email"
            id="email"
            class="form-control fm-cntrl"
            v-bind:class="form.errors.has('email')?'danger':''"

         placeholder="Email *"
                   onfocus="this.placeholder = ''" 
                   onblur="this.placeholder = 'Email *'"
                 
            v-model="form.email"
          >
          <p class="error" v-if="form.errors.has('email')" v-text="form.errors.get('email')"></p>



        </div>
        
  
        
  <div class="form-group">
                            <label>Select Room</label>

          <select
            name="room"
            id="room"
            class="form-control fm-cntrl"
            v-bind:class="form.errors.has('room')?'danger':''"

         placeholder="Select Room *"
                   onfocus="this.placeholder = ''" 
                   onblur="this.placeholder = 'Select Room *'"
                 
            v-model="form.room"
          >
            <option value="">Select Room*</option>
             <option v-for="val in roomtyp()" :key="val.id" :value="val.id">{{val.name}}</option>
      
            </select>
          <p class="error" v-if="form.errors.has('room')" v-text="form.errors.get('room')"></p>
        </div>

        <div class="form-group" id="check-out-datepicker" >
                                      <label>Number of Rooms</label>

                                       <input
            name="room_nos"
            id="room_nos"
            class="form-control fm-cntrl phone"
            v-bind:class="form.errors.has('room_nos')?'danger':''"
                    placeholder="Number Of Rooms*"
                   onfocus="this.placeholder = ''" 
                   onblur="this.placeholder = 'Number Of Rooms*'"
                             v-model="form.room_nos"
          >
          <p class="error" v-if="form.errors.has('room_nos')" v-text="form.errors.get('room_nos')"></p>


        </div>
       
        
          
  <div class="form-group">
                                      <label>Checkout</label>


                                                <flat-pickr
           name="check_out"
            id="check_out"
             :config="expire"
            class="form-control fm-cntrl"
            v-bind:class="form.errors.has('check_out')?'danger':''"
                    placeholder="Check Out*"
                   onfocus="this.placeholder = ''" 
                   onblur="this.placeholder = 'Check Out*'"
                             v-model="form.check_out"
                             
          ></flat-pickr>
          <p class="error" v-if="form.errors.has('check_out')" v-text="form.errors.get('check_out')"></p>



        </div>
  <div class="loader">
      <img
        :class="{ isloading : !form.isLoading() }"
        src="frondend/images/loading.gif"
        id="loadering"
        width="40"
      >
       <input name="txtcaptcha" id="txtcaptcha" type="hidden" value>
      <input name="hiddencaptcha" id="hiddencaptcha" type="hidden" value>
      <input name="send_contact" type="hidden" value="1">
    </div>
              <vue-recaptcha
          ref="recaptcha"
         
          @verify="onCaptchaVerified"
          @expired="onCaptchaExpired"
          size="invisible"
          :sitekey="MIX_NOCAPTCHA_SITEKEY"
        ></vue-recaptcha>
       
 </div>
    </div>
   
             <button   type="submit"
        class="btn btn-primary item-btn btn-lg"
        :disabled="form.isLoading()"
        name="checkbut"
        id="checkbut"
      >SUBMIT</button>
        </div>
       
  
    
      
 </form>
</template>

<script>
import VueRecaptcha from 'vue-recaptcha';
import flatPickr from "vue-flatpickr-component";
import "flatpickr/dist/flatpickr.css";
import "flatpickr/dist/themes/material_blue.css";
export default {
  props: ["action","roomtypes","mealtypes"],
  data() {
    return {
      form: new Form({
        name: "",
        phone:"",
        email: "",
         room: "",
         person_nos: "",
         room_nos: "",
         check_in: "",
         check_out: "",
         meal_plan: "",
        grecaptcharesponse: ""
      }),
      config: {
        wrap: false, // set wrap to true only when using 'input-group'
        altFormat: "j F, Y",
        altInput: true,
        dateFormat: "d-m-Y",
        minDate: "today",

      },
      expire:{
        wrap: false, // set wrap to true only when using 'input-group'
        altFormat: "j F, Y",
        altInput: true,
        dateFormat: "d-m-Y",
        minDate: "today",
      }
      
      
      ,
      MIX_NOCAPTCHA_SITEKEY: window.MIX_NOCAPTCHA_SITEKEY
    };
  }, 
  computed: {
   isError: function() {
      "is-danger";
    },
    checkIn() {
      return this.form.check_in;
    },
    checkOut () {
      return this.form.check_out;
    }
  },

  watch: {
    checkIn() {
      document.querySelector('#check-in-datepiker .input').classList.add('notEmpty');
    },
    checkOut() {
      document.querySelector('#check-out-datepicker .input').classList.add('notEmpty');
    },
  
    
  },

  components: {
    "vue-recaptcha": VueRecaptcha,
    flatPickr
  },
 

  methods: {
    onSubmit() {

      // this.form.grecaptcharesponse = $("#g-recaptcha-response").val();

      this.$refs.recaptcha.execute();
    },

    onCaptchaVerified: function(recaptchaToken) {
      this.form.grecaptcharesponse = recaptchaToken;
      this.form
        .post(this.action)
        .then(data => {
          this.$refs.recaptcha.reset();

          $(".msh").html(
            "<strong>Thank you. We will be in touch soon</strong> "
          );
          $(".msh").removeClass("hide");
          $(".msh").removeAttr("style");
          $(".msh")
            .addClass("show")
            .delay(5000)
            .hide("slow")
            .removeClass("show");
          // $("#BookOnline").modal("hide");
        })
        .catch(() => {
          this.$refs.recaptcha.reset();
        });
    },
    onCaptchaExpired: function() {
      this.$refs.recaptcha.reset();
    },
    roomtyp:function(){
      return JSON.parse(this.roomtypes);
    },
    mealtyp:function(){
      return JSON.parse(this.mealtypes);
    }
  }
};
</script>
<style>.isloading {
  display: none;
}

.msh {
  width: 100%;
  min-height: 0px;
  margin: 10px auto;
  text-align: center;
  background: #d5d5d5;
  border-radius: 3px;
  float: left;
  line-height: 40px;
}
.error {
  color: red;
}
</style>
