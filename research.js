topics = ["behavioral","cellBio","clinical","cognition","comp","imaging","molecular","developmental","disease","neuroethology", "neurogenetics", "synaptic", "systems"]
desc1 = ["Behavioral Neuroscience is the study of the biological basis of behavior in humans and animals. This discipline typically examines the brain's neurotransmissions and the psychological events associated with biological activity.", "Cell Biology of neurons, muscle & glia aims to elucidate structural components involved in the cell biology of learning and memory.","Clinical neuroscience is a branch of neuroscience that focuses on the scientific study of fundamental mechanisms that underlie diseases and disorders of the brain and central nervous system. It seeks to develop new ways of conceptualizing and diagnosing such disorders and ultimately of developing novel treatments.", "Cognition, Perception, and Cognitive Neuroscience (CPCN) probes how humans perceive, remember, think, learn, and act upon the world. The research is concerned with the development of basic theories of perception and cognition and the biological basis", "Computational neuroscience (also known as theoretical neuroscience or mathematical neuroscience) is a branch of neuroscience which employs mathematical models, theoretical analysis and abstractions of the brain to understand the principles that govern the development, structure, physiology and cognitive abilities of the nervous system.", "Functional and molecular imaging modalities are promising for non-invasive diagnosis and evaluation of treatment response at an earlier time point than morphological imaging. The goals are to individualize diagnostic work-up and treatment, in order to optimize treatment outcome and minimize toxicity."]
desc2 = ["In postsynaptic cells, neurotransmitter receptors receive signals that trigger an electrical signal, by regulating the activity of ion channels. The influx of ions through ion channels opened due to the binding of neurotransmitters to specific receptors can change the membrane potential of a neuron. Research in the Ion Channels, Neurotransmitter Receptors + Molecular Signaling field aims to uncover the molecular mechanisms of these processes.", "Neuroplasticity – or brain plasticity – is the ability of the brain to modify its connections or re-wire itself. Without this ability, any brain, not just the human brain, would be unable to develop from infancy through to adulthood or recover from brain injury. Research in this field observes the effects of the environment on the development of the brain.", "The mission of Neurodegenerative Disease Research is to promote and conduct multidisciplinary clinical and basic research to increase the understanding of the causes and mechanisms leading to brain dysfunction and degeneration in neurodegenerative diseases such as Alzheimer’s disease and Parkinson’s disease, to name a few. The mission of NDR can be summed into two overarching goals: 1.) Find better ways to cure and treat these disorders, 2. Provide training to the next generation of scientists.", "Neuroethology is the evolutionary and comparative approach to the study of animal behavior and its underlying mechanistic control by the nervous system. It is an interdisciplinary science that combines both neuroscience (study of the nervous system) and ethology (study of animal behavior in natural conditions).", "Neurogenetics is a new field of scientific research that uses recent advances in genome sequencing in order to better understand the cause of brain and nerve disorders.", "Systems biology and small circuits research aims to understanding how individual nerve cells communicate with each other at synapses and how the behavior of populations of synaptically connected cells is determined by this communication.", "Integrative neuroscience is the study of neuroscience that works to better understand complex structures and behaviors. The relationship between structure and function, and how the regions and functions connect to each other. Different parts of the brain carrying out different tasks, interconnecting to come together allowing complex behavior. Integrative neuroscience works to fill gaps in knowledge that can largely be accomplished with data sharing and simulations to create understanding of systems."]

var prev = 0;
function display_one(i){
        document.getElementById(topics[prev]).style.border = "";
        document.getElementById("description").innerText = desc1[i];
        document.getElementById(topics[i]).style.border = "2px solid";
	var c = document.getElementById(topics[i]).style.backgroundColor;
        console.log(c);
        if (c == "rgb(255, 140, 0)" || c == ""){
                document.getElementById(topics[prev]).style.backgroundColor = "#FF8C00";
                document.getElementById(topics[i]).style.backgroundColor = "#f0ac78";
        }
        prev = i;
}

function display_two(i){
        document.getElementById(topics[prev]).style.border = "";
        document.getElementById("description").innerText = desc2[i];
        document.getElementById(topics[i + 6]).style.border = "2px solid";
        var c = document.getElementById(topics[i + 6]).style.backgroundColor;
        if (c == "rgb(255, 140, 0)" || c == ""){
                document.getElementById(topics[prev]).style.backgroundColor = "#FF8C00";
                document.getElementById(topics[i + 6]).style.backgroundColor = "#f0ac78";
        }


	prev = i + 6;
}
