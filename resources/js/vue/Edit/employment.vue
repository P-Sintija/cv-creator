<template>
  <form>
    <div>
      <h3>Darba pieredze</h3>
      <div v-for="(employment, index) in employments" :key="index">
        <div>
          <label>Iestāde</label>
          <input
            type="text"
            v-model="employment.institution"
            value="employment.institution"
          />
        </div>
        <div>
          <label>Amats</label>
          <input
            type="text"
            v-model="employment.position"
            value="employment.position"
          />
        </div>
        <div>
          <label>Laika posms</label>
          <input
            type="text"
            v-model="employment.time"
            value="employment.time"
          />
        </div>
        <div>
          <label>Darba apraksts</label>
          <input
            type="text"
            v-model="employment.description"
            value="employment.description"
          />
        </div>
        <div>
          <label>Sasniegumi</label>
          <input
            type="text"
            v-model="employment.achievements"
            value="employment.achievements"
          />
        </div>
        <font-awesome-icon :icon="saveIcon" @click="editData(employment)" />
        <font-awesome-icon
          :icon="addIcon"
          @click="addEmployment(index)"
          v-show="index == employments.length - 1"
        />
        <font-awesome-icon
          :icon="removeIcon"
          @click="removeEmployment(index)"
          v-show="index || (!index && employments.length > 1)"
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
  props: ["userEmployment", "userEmploymentDescription", "userBasicData"],
  components: {
    FontAwesomeIcon,
  },
  data() {
    return {
      employments: [],
      removeIcon: faTrash,
      saveIcon: faSave,
      addIcon: faPlusSquare,
    };
  },
  beforeMount() {
    this.setEmploymentValues();
  },
  methods: {
    setEmploymentValues() {
      for (let i = 0; i < this.userEmployment.length; i++) {
        for (let j = 0; j < this.userEmploymentDescription.length; j++) {
          if (
            this.userEmployment[i].id ==
            this.userEmploymentDescription[j].employment_Id
          ) {
            this.employments.push({
              employmentId: this.userEmployment[i].id,
              userId: this.userBasicData.user_Id,
              institution: this.userEmployment[i].institution,
              position: this.userEmployment[i].position,
              time: this.userEmployment[i].time,
              description: this.userEmploymentDescription[j].description,
              achievements: this.userEmploymentDescription[j].achievements,
            });
          }
        }
      }
    },
    addEmployment() {
      this.employments.push({
        employmentId: 0,
        userId: this.userBasicData.user_Id,
        institution: "",
        position: "",
        time: "",
        description: "",
        achievements: "",
      });
    },
    removeEmployment(index) {
      if (this.employments[index].employmentId == 0) {
        this.employments.splice(index, 1);
      } else {
        this.deleteEmployment(this.employments[index].employmentId);
      }
    },
    deleteEmployment(id) {
      axios
        .post("delete/employment", {
          employmentId: id,
        })
        .then((response) => {
          console.log("done");
        })
        .catch((error) => {
          console.log(error);
        });
      location.reload();
    },
    editData(employmentField) {
      axios
        .post("update/employment", {
          employment: employmentField,
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