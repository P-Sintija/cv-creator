<template>
  <form>
    <div>
      <h3>Izglītība</h3>
      <div v-for="(education, index) in educations" :key="index">
        <div>
          <label>Iestāde</label>
          <input
            type="text"
            v-model="education.institution"
            value="education.institution"
          />
        </div>
        <div>
          <label>Virziens</label>
          <input
            type="text"
            v-model="education.faculty"
            value="education.faculty"
          />
        </div>
        <div>
          <label>Izglītības līmenis</label>
          <input
            type="text"
            v-model="education.level"
            value="education.level"
          />
        </div>
        <div>
          <label>Statuss</label>
          <select v-model="education.statuss">
            <option disabled value="">Izvēlaties vienu</option>
            <option>mācības pabeigtas</option>
            <option>pārtrauktas</option>
            <option>mācos</option>
          </select>
        </div>
        <div>
          <label>Laika posms</label>
          <input type="text" v-model="education.time" value="education.level" />
        </div>
        <font-awesome-icon :icon="saveIcon" @click="editData(education)" />
        <font-awesome-icon
          :icon="addIcon"
          @click="addEducation(index)"
          v-show="index == educations.length - 1"
        />
        <font-awesome-icon
          :icon="removeIcon"
          @click="removeEducation(index)"
          v-show="index || (!index && educations.length > 1)"
        />
      </div>
    </div>
  </form>
</template>
<script>
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { faPlusSquare } from "@fortawesome/free-solid-svg-icons";
import { faSave } from "@fortawesome/free-solid-svg-icons";
import { faTrash } from "@fortawesome/free-solid-svg-icons";

export default {
  props: ["userEducation", "userBasicData"],
  components: {
    FontAwesomeIcon,
  },
  data() {
    return {
      educations: [],
      removeIcon: faTrash,
      saveIcon: faSave,
      addIcon: faPlusSquare,
    };
  },
  beforeMount() {
    this.setEducationValues();
  },
  methods: {
    setEducationValues() {
      for (let i = 0; i < this.userEducation.length; i++) {
        this.educations.push({
          educationId: this.userEducation[i].id,
          userId: this.userBasicData.user_Id,
          institution: this.userEducation[i].institution,
          faculty: this.userEducation[i].faculty,
          level: this.userEducation[i].level,
          statuss: this.userEducation[i].statuss,
          time: this.userEducation[i].time,
        });
      }
    },
    addEducation() {
      this.educations.push({
        educationId: 0,
        userId: this.userBasicData.user_Id,
        institution: "",
        faculty: "",
        level: "",
        statuss: "",
        time: "",
      });
    },
    removeEducation(index) {
      if (this.educations[index].educationId == 0) {
        this.educations.splice(index, 1);
      } else {
        this.deleteEducation(this.educations[index].educationId);
      }
    },
    deleteEducation(id) {
      axios
        .post("delete/education", {
          educationId: id,
        })
        .then((response) => {
          console.log("done");
        })
        .catch((error) => {
          console.log(error);
        });
      location.reload();
    },
    editData(educationField) {
      axios
        .post("update/education", {
          education: educationField,
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