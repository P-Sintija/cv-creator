<template>
  <form>
    <div class="flex flex-col gap-4">
        <div class="flex flex-col gap-4 bg-gray-200 rounded p-8 shadow-md">
            <h3 class="text-3xl text-gray-700">Pamatdati</h3>
            <div class="flex flex-col">
                <label class="text-gray-700 select-none font-medium">Vārds</label>
                <input class="w-1/2 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                type="text" 
                v-model="basicData.name" />
            </div>
            <div class="flex flex-col">
                <label class="text-gray-700 select-none font-medium">Uzvārds</label>
                <input class="w-1/2 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                type="text" v-model="basicData.surname" />
            </div>
            <div class="flex flex-col">
                <label class="text-gray-700 select-none font-medium">Tālrunis</label>
                <input class="w-1/2 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                type="text" v-model="basicData.phone" />
            </div>
            <div class="flex flex-col">
                <label class="text-gray-700 select-none font-medium">epasts</label>
                <input class="w-1/2 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                type="email" v-model="basicData.email" />
            </div>
        </div>
        <div class="flex flex-col gap-4 bg-gray-200 rounded p-8 shadow-md">
            <h3 class="text-3xl text-gray-700">Adrese</h3>
            <div class="flex flex-col">
                <label class="text-gray-700 select-none font-medium">Valsts</label>
                <input class="w-1/2 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                type="text" v-model="address.country" />
            </div>
            <div class="flex flex-col">
                <label class="text-gray-700 select-none font-medium">Pilsēta</label>
                <input class="w-1/2 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                type="text" v-model="address.city" />
            </div>
            <div class="flex flex-col">
                <label class="text-gray-700 select-none font-medium">Iela</label>
                <input class="w-1/2 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                type="text" v-model="address.street" />
            </div>
            <div class="flex flex-col">
                <label class="text-gray-700 select-none font-medium">Numurs</label>
                <input class="w-1/2 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                type="text" v-model="address.houseNumber" />
            </div>
            <div class="flex flex-col">
                <label class="text-gray-700 select-none font-medium">Indeks</label>
                <input class="w-1/2 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                type="text" v-model="address.postIndex" />
            </div>
        </div>
        <div class="flex flex-col gap-4 bg-gray-200 rounded p-8 shadow-md">
            <h3 class="text-3xl text-gray-700">Izglītība</h3>
            <div class="flex flex-col gap-4"
              v-for="(education, index) in educations" :key="index">
                <div class="flex flex-col">
                    <label class="text-gray-700 select-none font-medium">Iestāde</label>
                    <input class="w-1/2 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                    type="text" v-model="education.institution" />
                </div>
                <div class="flex flex-col">
                    <label class="text-gray-700 select-none font-medium">Virziens</label>
                    <input class="w-1/2 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                    type="text" v-model="education.faculty" />
                </div>
                <div class="flex flex-col">
                    <label class="text-gray-700 select-none font-medium">Izglītības līmenis</label>
                    <input class="w-1/2 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                    type="text" v-model="education.level" />
                </div>
                <div class="flex flex-col">
                    <label class="text-gray-700 select-none font-medium">Statuss</label>
                    <select class="w-1/2 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                      v-model="education.statuss">
                        <option disabled value="">Izvēlaties vienu</option>
                        <option>mācības pabeigtas</option>
                        <option>pārtrauktas</option>
                        <option>mācos</option>
                    </select>
                </div>
                <div class="flex flex-col">
                    <label class="text-gray-700 select-none font-medium">Laika posms</label>
                    <input class="w-1/2 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                    type="text" v-model="education.time" />
                </div>
                <div class="flex">
                  <font-awesome-icon 
                    class="h-9 text-green-400" style="width: 40px !important;"
                    :icon="addIcon"
                    @click="addEducation(index)"
                    v-show="index == educations.length - 1"
                    />
                  <font-awesome-icon
                    class="h-9 text-red-400" style="width: 28px !important;"
                    :icon="removeIcon"
                    @click="removeEducation(index)"
                    v-show="index || (!index && educations.length > 1)"
                    />
                  </div> 
            </div>
        </div>
        <div class="flex flex-col gap-4 bg-gray-200 rounded p-8 shadow-md">
            <h3 class="text-3xl text-gray-700">Darba pieredze</h3>
            <div class="flex flex-col gap-4" 
              v-for="(employment, index) in employments" :key="index">
                <div class="flex flex-col">
                    <label class="text-gray-700 select-none font-medium">Iestāde</label>
                    <input class="w-1/2 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                    type="text" v-model="employment.institution" />
                </div>
                <div class="flex flex-col">
                    <label class="text-gray-700 select-none font-medium">Amats</label>
                    <input class="w-1/2 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                    type="text" v-model="employment.position" />
                </div>
                <div class="flex flex-col">
                    <label class="text-gray-700 select-none font-medium">Laika posms</label>
                    <input class="w-1/2 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                    type="text" v-model="employment.time" />
                </div>
                <div class="flex flex-col">
                    <label class="text-gray-700 select-none font-medium">Darba apraksts</label>
                    <input class="w-1/2 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                    type="text" v-model="employment.description" />
                </div>
                <div class="flex flex-col">
                    <label class="text-gray-700 select-none font-medium">Sasniegumi</label>
                    <input class="w-1/2 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                    type="text" v-model="employment.achievements" />
                </div>
                <div class="flex">
                  <font-awesome-icon 
                    class="h-9 text-green-400" style="width: 40px !important;"
                    :icon="addIcon"
                    @click="addEmployment(index)"
                    v-show="index == employments.length - 1"
                    />
                  <font-awesome-icon
                    class="h-9 text-red-400" style="width: 28px !important;"
                    :icon="removeIcon"
                    @click="removeEmployment(index)"
                    v-show="index || (!index && employments.length > 1)"
                    />
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-4 px-8 py-2 rounded-md text-gray-700 select-none font-medium shadow bg-gray-200">
            <div class="flex gap-3 items-center" v-if="!showLanguages" @click="languageFields()">
                <font-awesome-icon v-if="!showLanguages" :icon="angleDownIcon"
                  />
                <span>Pievienot valodas</span>  
            </div>
            <div class="flex gap-3 items-center" v-if="showLanguages" @click="hideLanguages()">
                <font-awesome-icon v-if="showLanguages" :icon="angleUpIcon"
                  />
                <span>Slept valodas</span>  
            </div>      
            <div class="flex flex-col gap-4"
              v-if="showLanguages">
                <h3 class="text-3xl text-gray-700">Valodas</h3>
                <div class="flex flex-col gap-4" 
                  v-for="(language, index) in languages" :key="index">
                    <div class="flex flex-col">
                        <label class="text-gray-700 select-none font-medium">Valoda</label>
                        <input class="w-1/2 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                          type="text" v-model="language.language" />
                    </div>
                    <div class="flex flex-col">
                        <label class="text-gray-700 select-none font-medium">Līmenis</label>
                        <input class="w-1/2 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                          type="text" v-model="language.level" />
                    </div>
                    <div class="flex">
                        <font-awesome-icon
                          class="h-9 text-green-400" style="width: 40px !important;"
                          :icon="addIcon"
                          @click="addLanguage(index)"
                          v-show="index == languages.length - 1"
                         />
                        <font-awesome-icon
                          class="h-9 text-red-400" style="width: 28px !important;"
                          :icon="removeIcon"
                          @click="removeLanguage(index)"
                          v-show="index || (!index && languages.length > 1)"
                          />
                      </div>  
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
        <div v-if="success" class="flex flex-col rounded p-8 shadow-md border-green-100 bg-green-50 text-green-800">
            <b>CV veiksmīgi izveidots</b>
        </div>
        <button 
          class="bg-green-500 text-white px-6 py-2 rounded font-medium shadow-md
          hover:bg-green-600 transition duration-200 each-in-out"
          @click="addData()" 
          type="button">
            Izveidot
        </button>
    </div>
  </form>
</template>

<script>
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { faPlusSquare } from "@fortawesome/free-solid-svg-icons";
import { faTrash } from "@fortawesome/free-solid-svg-icons";
import { faAngleDown } from "@fortawesome/free-solid-svg-icons";
import { faAngleUp } from "@fortawesome/free-solid-svg-icons";

export default {
  components: {
    FontAwesomeIcon,
  },
  data() {
    return {
      basicData: {
        name: "",
        surname: "",
        phone: "",
        email: "",
      },
      address: {
        country: "",
        city: "",
        street: "",
        houseNumber: "",
        postIndex: "",
      },
      educations: [
        {
          institution: "",
          faculty: "",
          level: "",
          statuss: "",
          time: "",
        },
      ],
      employments: [
        {
          institution: "",
          position: "",
          time: "",
          description: "",
          achievements: "",
        },
      ],
      showLanguages: false,
      languages: [],
      removeIcon: faTrash,
      addIcon: faPlusSquare,
      angleDownIcon: faAngleDown,
      angleUpIcon: faAngleUp,
      errors: [],
      success: false,
    };
  },
  methods: {
    checkForm() {
      this.errors = [];
      this.validateBasicData();
      this.validateAddress();
      this.validateEducation();
      this.validateEmployment();
      this.validateLanguage();

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
    validateAddress() {
      if (!this.address.country) {
        this.errors.push("Country required.");
      }
      if (!this.address.city) {
        this.errors.push("City required.");
      }
    },
    validateEducation() {
      const institutionError = "Institution required.";
      const statussError = "Statuss required.";
      const timeError = "Time required.";

      for (let i = 0; i < this.educations.length; i++) {
        if (
          !this.educations[i].institution &&
          !this.errors.includes(institutionError)
        ) {
          this.errors.push(institutionError);
        }
        if (
          !this.educations[i].statuss &&
          !this.errors.includes(statussError)
        ) {
          this.errors.push(statussError);
        }
        if (!this.educations[i].time && !this.errors.includes(timeError)) {
          this.errors.push(timeError);
        }
      }
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
    validateLanguage() {
      const languageError = "Language required.";

      for (let i = 0; i < this.languages.length; i++) {
        if (
          !this.languages[i].language &&
          !this.errors.includes(languageError)
        ) {
          this.errors.push(languageError);
        }
      }
    },
    addEducation() {
      this.educations.push({
        institution: "",
        faculty: "",
        level: "",
        statuss: "",
        time: "",
      });
    },
    removeEducation(index) {
      this.educations.splice(index, 1);
    },
    addEmployment() {
      this.employments.push({
        institution: "",
        position: "",
        time: "",
        description: "",
        achievements: "",
      });
    },
    removeEmployment(index) {
      this.employments.splice(index, 1);
    },
    languageFields() {
      this.showLanguages = true;
      this.addLanguage();
    },
    hideLanguages() {
      this.showLanguages = false;
      this.languages = [];
    },
    addLanguage() {
      this.languages.push({
        language: "",
        level: "",
      });
    },
    removeLanguage(index) {
      this.languages.splice(index, 1);
    },
    addData() {
      if (this.checkForm()) {
        axios
          .post("create", {
            basicData: this.basicData,
            address: this.address,
            educations: this.educations,
            employments: this.employments,
            languages: this.languages,
          })
          .then((response) => {
            this.success = true;
          })
          .catch((error) => {
            console.log(error);
          });
      }
    },
  },
};
</script>