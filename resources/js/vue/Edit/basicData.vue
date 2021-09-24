<template>
  <form class="flex flex-col gap-4 bg-gray-200 rounded p-8 shadow-md">
    <div class="flex flex-col gap-4">
      <h3 class="text-3xl text-gray-700">Pamatdati</h3>
      <div class="flex flex-col">
        <label class="text-gray-700 select-none font-medium">Vārds</label>
        <input class="w-1/2 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" 
        type="text" v-model="basicData.name" value="basicData.name" />
      </div>
      <div class="flex flex-col">
        <label class="text-gray-700 select-none font-medium">Uzvārds</label>
        <input class="w-1/2 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
          type="text"
          v-model="basicData.surname"
          value="basicData.surname"
        />
      </div>
      <div class="flex flex-col">
        <label class="text-gray-700 select-none font-medium">Tālrunis</label>
        <input class="w-1/2 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
        type="text" v-model="basicData.phone" value="basicData.phone" />
      </div>
      <div class="flex flex-col">
        <label class="text-gray-700 select-none font-medium">epasts</label>
        <input class="w-1/2 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
        type="email" v-model="basicData.email" value="basicData.email" />
      </div>
    </div>
    <font-awesome-icon  class="h-9 text-yellow-500" style="width: 40px !important;"
      :icon="saveIcon" @click="editData()" 
      />
    <div v-if="errors.length" class="flex flex-col rounded p-8 shadow-md border-red-100 bg-red-50 text-red-800">
        <p>
          <b>Please correct the following error(s):</b>
          <ul>
            <li v-for="(error, index) in errors" :key="index">{{ error }}</li>
          </ul>
        </p>
    </div>
  </form>
</template>

<script>
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { faSave } from "@fortawesome/free-solid-svg-icons";

export default {
  components: {
    FontAwesomeIcon,
  },
  props: ["userBasicData"],
  data() {
    return {
      basicData: {
        userId: "",
        name: "",
        surname: "",
        phone: "",
        email: "",
      },
      saveIcon: faSave,
      errors: [],
    };
  },
  beforeMount() {
    this.setValues();
  },
  methods: {
    setValues() {
      this.basicData.userId = this.userBasicData.user_Id;
      this.basicData.name = this.userBasicData.name;
      this.basicData.surname = this.userBasicData.surname;
      this.basicData.phone = this.userBasicData.phone;
      this.basicData.email = this.userBasicData.email;
    },
    checkForm() {
      this.errors = [];
      this.validateBasicData();

      if (this.errors.length > 0) {
        return false;
      }
      return true;
    },
    validateBasicData() {
      if (!this.basicData.name) {
        this.errors.push("Name required.");
      }
      if (!this.basicData.surname) {
        this.errors.push("Surname required.");
      }
      if (!this.basicData.email) {
        this.errors.push("Email required.");
      }
    },
    editData() {
      if (this.checkForm()) {
        axios
          .post("update/basicData", {
            basicData: this.basicData,
          })
          .then((response) => {
            console.log("done");
          })
          .catch((error) => {
            console.log(error);
          });
      }
    },
  },
};
</script>