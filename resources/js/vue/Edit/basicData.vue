<template>
  <form>
    <div>
      <h3>Pamatdati</h3>
      <div>
        <label>Vārds</label>
        <input type="text" v-model="basicData.name" value="basicData.name" />
      </div>
      <div>
        <label>Uzvārds</label>
        <input
          type="text"
          v-model="basicData.surname"
          value="basicData.surname"
        />
      </div>
      <div>
        <label>Tālrunis</label>
        <input type="text" v-model="basicData.phone" value="basicData.phone" />
      </div>
      <div>
        <label>epasts</label>
        <input type="email" v-model="basicData.email" value="basicData.email" />
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
    editData() {
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
    },
  },
};
</script>