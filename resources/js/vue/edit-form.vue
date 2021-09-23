<template>
  <div class="container">
    <basicData v-bind:userBasicData="userBasicData" />
    <addressField v-bind:userAddress="userAddress" />
    <education
      v-bind:userEducation="userEducation"
      v-bind:userBasicData="userBasicData"
    />
    <employment
      v-bind:userEmployment="userEmployment"
      v-bind:userEmploymentDescription="userEmploymentDescription"
      v-bind:userBasicData="userBasicData"
    />
  </div>
</template>

<script>
import basicData from "./Edit/basicData.vue";
import addressField from "./Edit/address.vue";
import education from "./Edit/education.vue";
import employment from "./Edit/employment.vue";

export default {
  props: [
    "userBasicData",
    "userAddress",
    "userEducation",
    "userEmployment",
    "userEmploymentDescription",
  ],
  components: {
    basicData,
    addressField,
    education,
    employment,
  },
};
</script>


