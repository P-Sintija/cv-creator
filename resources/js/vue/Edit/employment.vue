<template>
  <form class="flex flex-col gap-4 bg-gray-200 rounded p-8 shadow-md">
    <div>
      <h3 class="text-3xl text-gray-700">Darba pieredze</h3>
      <div  class="flex flex-col gap-4"
        v-for="(employment, index) in employments" :key="index">
        <div class="flex flex-col">
          <label class="text-gray-700 select-none font-medium">Iestāde</label>
          <input class="w-1/2 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
            type="text"
            v-model="employment.institution"
            value="employment.institution"
          />
        </div>
        <div class="flex flex-col">
          <label class="text-gray-700 select-none font-medium">Amats</label>
          <input class="w-1/2 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
            type="text"
            v-model="employment.position"
            value="employment.position"
          />
        </div>
        <div class="flex flex-col">
          <label class="text-gray-700 select-none font-medium">Laika posms</label>
          <input class="w-1/2 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
            type="text"
            v-model="employment.time"
            value="employment.time"
          />
        </div>
        <div class="flex flex-col">
          <label class="text-gray-700 select-none font-medium">Darba apraksts</label>
          <input class="w-1/2 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
            type="text"
            v-model="employment.description"
            value="employment.description"
          />
        </div>
        <div class="flex flex-col">
          <label class="text-gray-700 select-none font-medium">Sasniegumi</label>
          <input class="w-1/2 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
            type="text"
            v-model="employment.achievements"
            value="employment.achievements"
          />
        </div>
        <div>
          <font-awesome-icon class="h-9 text-yellow-500" style="width: 40px !important;"
            :icon="saveIcon" 
            @click="editData(employment)" 
            v-show="index == employments.length - 1"
          />
          <font-awesome-icon class="h-9 text-green-400" style="width: 40px !important;"
            :icon="addIcon"
            @click="addEmployment(index)"
            v-show="index == employments.length - 1"
          />
          <font-awesome-icon class="h-9 text-red-400" style="width: 28px !important;"
            :icon="removeIcon"
            @click="removeEmployment(index)"
            v-show="index || (!index && employments.length > 1)"
          />
        </div>
      </div>
    </div>
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
      errors: [],
    };
  },
  beforeMount() {
    this.setEmploymentValues();
  },
  methods: {
    checkForm() {
      this.errors = [];
      this.validateEmployment();

      if (this.errors.length > 0) {
        return false;
      }
      return true;
    },
    validateEmployment() {
      const institutionError = "Employment institution required.";
      const positionError = " Employment position required.";
      const timeError = "Employment time required.";

      for (let i = 0; i < this.employments.length; i++) {
        if (
          !this.employments[i].institution &&
          !this.errors.includes(institutionError)
        ) {
          this.errors.push(institutionError);
        }
        if (
          !this.employments[i].position &&
          !this.errors.includes(positionError)
        ) {
          this.errors.push(positionError);
        }
        if (!this.employments[i].time && !this.errors.includes(timeError)) {
          this.errors.push(timeError);
        }
      }
    },
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
      if (this.checkForm()) {
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
      }
    },
  },
};
</script>