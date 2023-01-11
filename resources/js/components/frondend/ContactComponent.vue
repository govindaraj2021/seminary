<template>

  <form
    id="form_main"
    class="form-area"
    method="post"
    @submit.prevent="onSubmit"
    @keydown="form.errors.clear($event.target.name)"
  >
           
                            
   
      <div class="col-md-12">
        <div class="msh"></div>
      </div>

      <div >

          <input
            name="name"
            id="name"
            class="form-control form-control-lg"
            v-bind:class="form.errors.has('name')?'danger':''"

         placeholder="Name *"
                   onfocus="this.placeholder = ''" 
                   onblur="this.placeholder = 'Name *'"
                 
            v-model="form.name"
          >
          <p class="error" v-if="form.errors.has('name')" v-text="form.errors.get('name')"></p>
        </div>
  <div>

                <input
                  pattern="[0-9]*"
                  inputmode="numeric"
                  type="tel"
                              v-bind:class="form.errors.has('phone')?'danger':''"

                  maxlength="20"
                  class="form-control form-control-lg phone"
      placeholder="Phone *"
                   onfocus="this.placeholder = ''" 
                   onblur="this.placeholder = 'Phone *'"                  id="phone"
                  name="phone"
                  v-model="form.phone"
                >
                <span
                  class="error"
                  v-if="form.errors.has('phone')"
                  v-text="form.errors.get('phone')"
                ></span>
              </div>


        <div >
          <input
            name="email"
            id="email"
            class="form-control form-control-lg"
            v-bind:class="form.errors.has('email')?'danger':''"
                    placeholder="Email"
                   onfocus="this.placeholder = ''" 
                   onblur="this.placeholder = 'Email'"
                             v-model="form.email"
          >
          <p class="error" v-if="form.errors.has('email')" v-text="form.errors.get('email')"></p>

          <div id="emailInfo" class="fieldreq"></div>
        </div>
       




      <div >

          <textarea
            rows=""
            cols="10"
            name="message"
            maxlength="255"
                  placeholder="How can we help you? *"
                   onfocus="this.placeholder = ''" 
                   onblur="this.placeholder = 'How can we help you? *'"
            class="form-control form-control-lg"
            v-bind:class="form.errors.has('message')?'danger':''"
            id="message"
            v-model="form.message"
          ></textarea>
          <small class="error">Max. 255 characters</small>
          <p class="error" v-if="form.errors.has('message')" v-text="form.errors.get('message')"></p>
        </div>
  
    <vue-recaptcha
          ref="recaptcha"
          @verify="onCaptchaVerified"
          @expired="onCaptchaExpired"
          size="invisible"
          :sitekey="MIX_NOCAPTCHA_SITEKEY"
        ></vue-recaptcha>

    <div class="loader">
      <img
        :class="{ isloading : !form.isLoading() }"
        src="frondend/images/loading.gif"
        id="loadering"
        width="40"
      >
    </div>
    <div >
      <button
        type="submit"
        class="btn btn-primary item-btn btn-lg"
        :disabled="form.isLoading()"
        name="checkbut"
        id="checkbut"
      >Send</button>

      <input name="txtcaptcha" id="txtcaptcha" type="hidden" value>
      <input name="hiddencaptcha" id="hiddencaptcha" type="hidden" value>
      <input name="send_contact" type="hidden" value="1">
    </div>
   
  
 
  </form>
</template>

<script>
import VueRecaptcha from 'vue-recaptcha';

export default {
  props: ["action"],
  data() {
    return {
      form: new Form({
        name: "",
        phone:"",
        email: "",

        message: "",
        grecaptcharesponse: ""
      }),
      MIX_NOCAPTCHA_SITEKEY: window.MIX_NOCAPTCHA_SITEKEY
    };
  },
  computed: {
    isError: function() {
      "is-danger";
    }
  },
  components: {
    "vue-recaptcha": VueRecaptcha
  },

  methods: {
    onSubmit() {
      console.log("hit")
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
    }
  }
};
</script>
<style>
.msh {
  width: 50%;
  margin: 10px auto;
  text-align: center;
  background: #d5d5d5;
  border-radius: 3px;
  line-height: 40px;
}
</style>
