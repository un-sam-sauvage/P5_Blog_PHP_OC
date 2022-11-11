/**
 * Joris Gourdon (un petit peu Samuel Barbeau) - 12/09/2022
 * Création d'un module pour les appels Ajax
 */

/**
 * 
 * @param {string} url le nom du fichier Ajax que l'on va exécuter
 * @param {object | null} data les données que l'on veut passer en POST
 */
 export function fct_fetchData(url, data) {
	let request = {
		method:"POST",
		body: fct_objectToFormData(data)
	}

	return fetch(
		'../../src/Controller/ajax/' + url,
		request
	).then(
		(resp) => {
			return resp.json();
		}
	).catch ((error) => {
		console.log(error);
	})
}

function fct_objectToFormData(obj, form, namespace) {
	var fd = form || new FormData();
	var formKey;
	
	for(var property in obj) {
		if(obj.hasOwnProperty(property)) {
			
			if(namespace)
				formKey = namespace + '[' + property + ']';
			else
				formKey = property;
	
			// if the property is an object, but not a File,
			if(typeof obj[property] === 'object' && !(obj[property] instanceof File))
				fct_objectToFormData(obj[property], fd, property);
			 else 
				fd.append(formKey, obj[property]); // if it's a string or a File object
		}
	}
	return fd;
}