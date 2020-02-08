<template>
  <div>
    <div class="container">
      <h2 class="title">Registration</h2>
      <form>
        <div class="form-group">
          <div class="c-validation" aria-hidden="true" v-if="errorMessage.mobile_number">
            <div v-for="message in errorMessage.mobile_number" :key="message">{{message}}</div>
          </div>
          <input
            type="text"
            class="form-control"
            placeholder="Mobile Number"
            v-model="formData.mobile_number"
            :disabled="isGreyOut"
          />
        </div>
        <div class="form-group">
          <div class="c-validation" aria-hidden="true" v-if="errorMessage.first_name">
            <div v-for="message in errorMessage.first_name" :key="message">{{message}}</div>
          </div>
          <input
            type="text"
            class="form-control"
            placeholder="First Name"
            v-model="formData.first_name"
            :disabled="isGreyOut"
          />
        </div>
        <div class="form-group">
          <div class="c-validation" aria-hidden="true" v-if="errorMessage.last_name">
            <div v-for="message in errorMessage.last_name" :key="message">{{message}}</div>
          </div>
          <input
            type="text"
            class="form-control"
            placeholder="Last Name"
            v-model="formData.last_name"
            :disabled="isGreyOut"
          />
        </div>

        <div class="form-row">
          <div class="form-group col-md-2">
            <select class="form-control" :disabled="isGreyOut" v-model="birth.month">
              <option selected value="Month">Month</option>
              <option value="January">January</option>
              <option value="February">February</option>
              <option value="March">March</option>
              <option value="April">April</option>
              <option value="May">May</option>
              <option value="June">June</option>
              <option value="July">July</option>
              <option value="August">August</option>
              <option value="September">September</option>
              <option value="October">October</option>
              <option value="November">November</option>
              <option value="December">December</option>
            </select>
          </div>
          <div class="form-group col-md-2">
            <select class="form-control" :disabled="isGreyOut" v-model="birth.date">
              <option selected value="Date">Date</option>
              <option v-for="date in 31" :key="date" :value="date">{{date}}</option>
            </select>
          </div>
          <div class="form-group col-md-2">
            <select class="form-control" :disabled="isGreyOut" v-model="birth.year">
              <option selected value="Year">Year</option>
              <option v-for="year in 50" :key="year" :value="2021 - year">{{2021 - year}}</option>
            </select>
          </div>

          <div class="c-validation birthdate" aria-hidden="true" v-if="errorMessage.birthdate">
            <div v-for="message in errorMessage.birthdate" :key="message">{{message}}</div>
          </div>
        </div>
        <div class="form-check form-check-inline">
          <input
            class="form-check-input"
            type="radio"
            id="male"
            value="male"
            name="gender"
            v-model="formData.gender"
          />
          <label class="form-check-label" for="male">Male</label>
        </div>
        <div class="form-check form-check-inline">
          <input
            class="form-check-input"
            type="radio"
            id="female"
            value="female"
            name="gender"
            v-model="formData.gender"
          />
          <label class="form-check-label" for="female">Female</label>
        </div>

        <div class="form-group mt-3">
          <div class="c-validation" aria-hidden="true" v-if="errorMessage.email">
            <div v-for="message in errorMessage.email" :key="message">{{message}}</div>
          </div>
          <input
            type="text"
            class="form-control"
            placeholder="Email"
            v-model="formData.email"
            :disabled="isGreyOut"
          />
        </div>
        <button
          class="btn btn-primary btn-block btn-purple"
          type="button"
          @click="submit"
          :disabled="isGreyOut"
        >Register</button>
      </form>
    </div>

    <footer>{{successRegister ? 'LOGIN' : 'FOOTER'}}</footer>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      birth: {
        month: "Month",
        date: "Date",
        year: "Year"
      },
      formData: {},
      errorMessage: {},
      isGreyOut: false,
      successRegister: false
    };
  },
  mounted() {},
  methods: {
    submit() {
      this.isGreyOut = true;
      this.validationLocalData()
    },
    validationLocalData(){
      if (this.birth.month == "Month" && this.birth.date == "Date" && this.birth.year == "Year") {
        this.postDataToServer()
      }
      else if(this.birth.month != "Month" && this.birth.date != "Date" && this.birth.year != "Year"){
        this.formData.birth_date = `${this.birth.date} ${this.birth.month} ${this.birth.year}`
        this.postDataToServer()
      }
      else{
        this.errorMessage.birthdate = ["Birth date must be valid or leave it default !"];
        this.isGreyOut = false;
      }
    },
    postDataToServer(){
      axios
        .post("http://localhost:8000/mitrais-register", this.formData)
        .then(response => {
          console.log(response);
          if (response.status == 202) {
            this.errorMessage = response.data;
            this.isGreyOut = false;
          } else {
            this.errorMessage = {};
            this.successRegister = true;
          }
        })
        .catch(error => {
          console.log(error);
        });
    }
  }
};
</script>

<style scoped>
.title {
  margin-top: 100px;
}
.c-validation {
  float: right;
  background: #eb4d4b !important;
  padding: 10px 30px !important;
  border-radius: 5px !important;
  position: relative;
  display: block !important;
  box-shadow: 1px 1px 1px #aaaaaa;
  margin-bottom: 10px;
  color: white;
}
.c-validation::after {
  content: "";
  width: 0;
  height: 0;
  border-left: 10px solid transparent;
  border-right: 10px solid transparent;
  border-top: 10px solid #eb4d4b;
  position: absolute;
  bottom: -10px;
  right: 45%;
}
.c-validation.birthdate::after {
  border-top: 10px solid transparent;
  border-bottom: 10px solid transparent;
  border-right: 10px solid #eb4d4b;
  left: -18px;
  top: 12px;
}
.btn-purple, .btn-purple:active{
  background: purple !important;
  box-shadow: none !important;
  border: none;
}
footer {
  background: purple;
  color: white;
  text-align: center;
  padding: 50px;
  font-size: 3em;
  margin-top: 100px;
}
</style>