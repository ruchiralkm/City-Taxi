function getBotResponse(input) {
  // Simple responses
  if (input == "hello") {
    return "Hello there!";
  } else if (input == "hi") {
    return "Hello there!";
  } else if (input == "how to book ride") {
    return "Passenger -> Login -> Ride -> Book Ride";
  } else if (input == "goodbye") {
    return "Talk to you later!";
  } else {
    return "Try asking something else!";
  }
}
