<template>
  <form class="flex flex-col gap-4 bg-gray-200 rounded p-8 shadow-md">
    <div class="flex flex-col gap-4">
      <h3 class="text-3xl text-gray-700">Adrese</h3>
      <div class="flex flex-col">
        <label class="text-gray-700 select-none font-medium">Valsts</label>
        <input 
        type="text" class="w-1/2 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
        v-model="address.country" 
        value="address.country" 
        />
      </div>
      <div class="flex flex-col">
        <label class="text-gray-700 select-none font-medium">Pilsēta</label>
        <input class="w-1/2 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" type="text" v-model="address.city" value="address.city" />
      </div>
      <div class="flex flex-col">
        <label class="text-gray-700 select-none font-medium">Iela</label>
        <input class="w-1/2 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" type="text" v-model="address.street" value="address.street" />
      </div>
      <div class="flex flex-col">
        <label class="text-gray-700 select-none font-medium">Numurs</label>
        <input class="w-1/2 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
          type="text"
          v-model="address.houseNumber"
          value="address.houseNumber"
        />
      </div>
      <div class="flex flex-col">
        <label class="text-gray-700 select-none font-medium">Indeks</label>
        <input class="w-1/2 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
          type="text"
          v-model="address.postIndex"
          value="address.postIndex"
        />
      </div>
    </div>
    <font-awesome-icon class="h-9 text-yellow-500" style="width: 40px !important;"
      :icon="saveIcon" @click="editData()" />
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
  props: ["userAddress"],
  data() {
    return {
      address: {
        userId: "",
        country: "",
        city: "",
        street: "",
        houseNumber: "",
        postIndex: "",
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
      this.address.userId = this.userAddress.user_Id;
      this.address.country = this.userAddress.country;
      this.address.city = this.userAddress.city;
      this.address.street = this.userAddress.street;
      this.address.houseNumber = this.userAddress.houseNumber;
      this.address.postIndex = this.userAddress.postIndex;
    },
    checkForm() {
      this.errors = [];
      this.validateAddress();

      if (this.errors.length > 0) {
        return false;
      }
      return true;
    },
    validateAddress() {
      if (!this.address.country) {
        this.errors.push("Country required.");
      }
      if (!this.address.city) {
        this.errors.push("City required.");
      }
    },
    editData() {
      if (this.checkForm()) {
        axios
          .post("update/address", {
            address: this.address,
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