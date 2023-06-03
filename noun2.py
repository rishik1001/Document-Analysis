import pandas as pd
import numpy as np
from sklearn.feature_extraction.text import CountVectorizer
from sklearn.naive_bayes import MultinomialNB
from sklearn.metrics import accuracy_score
from sklearn.model_selection import train_test_split

# Load the dataset
data = pd.read_csv("dataset.csv")

# Split the dataset into training and testing data
X_train, X_test, y_train, y_test = train_test_split(data['text'], data['sentiment'], test_size=0.2, random_state=42)

# Define a function to extract n-grams from the text
def extract_ngrams(text, n):
    ngrams = []
    words = text.split()
    for i in range(len(words)-n+1):
        ngrams.append(" ".join(words[i:i+n]))
    return ngrams

# Convert the text data into feature vectors using n-grams
vectorizer = CountVectorizer(analyzer=lambda text: extract_ngrams(text, 2))
X_train = vectorizer.fit_transform(X_train)
X_test = vectorizer.transform(X_test)

# Train the Naive Bayes classifier
classifier = MultinomialNB()
classifier.fit(X_train, y_train)

# Prompt the user to input a file to analyze
filename = input("Enter the file name to analyze: ")

# Load the text from the file
with open(filename, "r") as f:
    text = f.read()

# Convert the user input into a feature vector using n-grams
X_user = vectorizer.transform([text])

# Make a prediction on the user input
prediction = classifier.predict(X_user)

# Print the predicted sentiment label
print(f"Predicted Sentiment Label: {prediction[0]}")
