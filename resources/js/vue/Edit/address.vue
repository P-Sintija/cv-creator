<template>
  <form>
    <div>
      <h3>Adrese</h3>
      <div>
        <label>Valsts</label>
        <input type="text" v-model="address.country" value="address.country" />
      </div>
      <div>
        <label>Pilsēta</label>
        <input type="text" v-model="address.city" value="address.city" />
      </div>
      <div>
        <label>Iela</label>
        <input type="text" v-model="address.street" value="address.street" />
      </div>
      <div>
        <label>Numurs</label>
        <input
          type="text"
          v-model="address.houseNumber"
          value="address.houseNumber"
        />
      </div>
      <div>
        <label>Indeks</label>
        <input
          type="text"
          v-model="address.postIndex"
          value="address.postIndex"
        />
      </div>
    </div>

    <font-awesome-icon :icon="saveIcon" @click="editData()" />
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
    editData() {
      console.log(this.address);
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
    },
  },
};
</script>