careers = ["neurologist","labtech","educator","image","engineer","professor","scientist","ma","pharm","psycg"]
desc1 = ["A neurologist is a medical doctor with specialized training in diagnosing, treating, and managing disorders of the brain and nervous system including, but not limited to, Alzheimer's disease, amyotrophic lateral sclerosis (ALS), concussion, epilepsy, migraine, multiple sclerosis, Parkinson's disease, and stroke.","A lab technician works in a laboratory setting and works in various capacities to fulfill required duties. This includes diagnostic testing on bodily fluids, organic matter and chemicals. They use high-specialized equipment to measure and report their findings. They use their training to collect samples and safely store biomedical materials and tools.","The duties of a health educator include promoting and improving community health by educating community members on health behaviors. They may perform research related to the current health conditions of a community and work with other health professionals to design and implement health plans that will encourage healthier lifestyles.","Neuroimaging technicians work with physicians to understand what they need from the imaging. They are able to manipulate the angles to capture the best imaging. Technicians must also move patients on the examination table and position them correctly for the best image. Written and verbal communication skills are important and so is the ability to work with physicians and patients. Many neuroimaging technicians work as part of a team, so being able to be a team player is helpful.","Neural engineering (also known as neuroengineering) is a discipline within biomedical engineering that uses engineering techniques to understand, repair, replace, or enhance neural systems. Neural engineers are uniquely qualified to solve design problems at the interface of living neural tissue and non-living constructs."]
desc2 = ["Neuroscience professors work in universities, educating students in a range of basic to advanced neuroscience topics. Professors divide their time into supervising roles, attending conferences, conducting and publishing research, and assisting other faculty members. Along with preparing courses and presenting, they are often lead research in their field, adding value to both students and the university's reputation.","Research scientists gather information and generate knowledge through both theoretical and experimental means. These scientists develop hypotheses, collect data, and interpret results to answer questions in both the natural world and the man made world.","A medical assistant is responsible for everything from administrative work to patient and physician support tasks at hospitals, doctor offices, medical clinics, and other facilities. They may help to get a patient's medical history information or to take their vital signs. The scope of their work will depend on the needs of the facility or practice.","Pharmacists are medication experts and play a critical role in helping people get the best results from their medications. Pharmacists prepare and dispense prescriptions, ensure medicines and doses are correct, prevent harmful drug interactions, and counsel patients on the safe and appropriate use of their medications. They have specialized expertise about the composition of medicines, including their chemical, biological, and physical properties, as well as their manufacture and use.","Neuropsychology is concerned with relationships between the brain and behavior. Neuropsychologists conduct evaluations to characterize behavioral and cognitive changes resulting from central nervous system disease or injury, like Parkinson’s disease or another movement disorder. Some neuropsychologists also focus on remediation of or adaptation to these behavioral and mental changes and other symptoms."]

var prev = 0;
function display_one(i){
        document.getElementById(careers[prev]).style.border = "";
        document.getElementById("description").innerText = desc1[i];
        document.getElementById(careers[i]).style.border = "2px solid";
        var c = document.getElementById(careers[i]).style.backgroundColor;
	console.log(c);
	if (c == "rgb(255, 140, 0)" || c == ""){
		document.getElementById(careers[prev]).style.backgroundColor = "#FF8C00";
		document.getElementById(careers[i]).style.backgroundColor = "#f0ac78";
	}
	prev = i;
}

function display_two(i){
        document.getElementById(careers[prev]).style.border = "";
        document.getElementById("description").innerText = desc2[i];
        document.getElementById(careers[i + 5]).style.border = "2px solid";
	var c = document.getElementById(careers[i + 5]).style.backgroundColor;
        if (c == "rgb(255, 140, 0)" || c == ""){
		document.getElementById(careers[prev]).style.backgroundColor = "#FF8C00";
                document.getElementById(careers[i + 5]).style.backgroundColor = "#f0ac78";
        }
        
	prev = i + 5;
}
